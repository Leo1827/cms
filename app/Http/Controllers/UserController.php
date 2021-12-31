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
                    return back()->with('message', 'Avatar actualizado con éxito.')->with('typealert', 'success');
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
            'apassword.required' => 'Escriba su contraseña actual',
            'apassword.min' => 'La contraseña actual debe de tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contraseña',
            'password.min' => 'Su nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña',
            'cpassword.min' => 'La confirmación de la contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput(); 
        else:
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message','La contraseña se actualizo con éxito')->with('typealert','success');
                endif;
            else:
                return back()->with('message','Su contraseña actual es errónea')->with('typealert','danger'); 
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
            'phone.required' => 'Su numero de teléfono es requerido',
            'phone.min' => 'El numero de teléfono debe de tener como minimo 10 dígitos',
            'year.required' => 'Su año de nacimiento es requerido',
            'day.required' => 'Su día de nacimiento es requerido'
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
                return back()->with('message', 'Su información se actualizo con éxto')->with('typealert','success');
            endif;
        endif;
    }
}
