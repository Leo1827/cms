<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\User;

class UserController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
    }
	public function getAccountEdit(){
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-', Auth::user()->birthday);
        $data = ['birthday' => $birthday];
		return view('user.account_edit', $data);
	}
	public function postAccountAvatar(Request $request){
	 	$rules = [
            'avatar' => 'required'
        ];

        $messages = [
            'avatar.required' => 'Seleccione una imagen'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput(); 
        else:
             if($request->hasFile('avatar')):
            $path = '/'.Auth::id(); 
            $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads_user.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

            $filename = rand(1,999).'_'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;


            $u = User::find(Auth::id());
            $aa = $u->avatar;
            $u->avatar = $filename;

                if($u->save()):
                    if($request->hasFile('avatar')):
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads_user');
                        $file_image = Image::make($file_file);
                        $file_image->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $file_image->save($upload_path.'/'.$path.'/av_'.$filename);
                    endif;
                    unlink($upload_path.'/'.$path.'/'.$aa);
                    unlink($upload_path.'/'.$path.'/av_'.$aa);
                    return back()->with('message', 'Avatar actualizado con ??xito.')->with('typealert', 'success');
                endif; 

            endif;
        endif;

        }

    public function postAccountPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8' ,
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'apassword.required' => 'Escriba su contrase??a actual',
            'apassword.min' => 'La contrase??a actual debe de tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contrase??a',
            'password.min' => 'Su nueva contrase??a debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contrase??a',
            'cpassword.min' => 'La confirmaci??n de la contrase??a debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contrase??as no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput(); 
        else:
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message','La contrase??a se actualizo con ??xito')->with('typealert','success');
                endif;
            else:
                return back()->with('message','Su contrase??a actual es err??nea')->with('typealert','danger'); 
            endif;    
        endif;
    } 

    public function postAccountInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required' ,
            'phone' => 'required|min:10',
            'year' => 'required',
            'day' => 'required'
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido',
            'lastname.min' => 'Su apellido es requerido',
            'phone.required' => 'Su numero de tel??fono es requerido',
            'phone.min' => 'El numero de tel??fono debe de tener como minimo 10 d??gitos',
            'year.required' => 'Su a??o de nacimiento es requerido',
            'day.required' => 'Su d??a de nacimiento es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput(); 
        else:
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("Y-m-d", strtotime($date));
            $u->gender = e($request->input('gender'));
            if($u->save()):
                return back()->with('message', 'Su informaci??n se actualizo con ??xto')->with('typealert','success');
            endif;
        endif;
    }
}
