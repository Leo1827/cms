const base = location.protocol+'//'+location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');
var page = 1;
var page_section = "";
var products_list_ids_temp = [];

$(document).ready(function(){
	$('.slick-slider').slick({dots: true, autoplay: true, autoplaySpeed: 2000});
});

document.addEventListener('DOMContentLoaded', function(){ 
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	})
	var slider = new MDSlider;
	var form_avatar_change = document.getElementById('form_avatar_change');
	var btn_avatar_edit = document.getElementById('btn_avatar_edit');
	var avatar_change_overlay = document.getElementById('avatar_change_overlay');
	var input_file_avatar = document.getElementById('input_file_avatar');
	var products_list = document.getElementById('products_list');
	var load_more_products = document.getElementById('load_more_products');

if(btn_avatar_edit){
	btn_avatar_edit.addEventListener('click', function(e){
		e.preventDefault();
		input_file_avatar.click();
	})
}

if(load_more_products){
	load_more_products.addEventListener('click', function(e){
		e.preventDefault();
		load_products(page_section);
	})
}

if(input_file_avatar){
	input_file_avatar.addEventListener('change', function(){
		var load_img = '<img src="'+base+'/static/images/loader.svg"/>';
		avatar_change_overlay.innerHTML = load_img;
		avatar_change_overlay.style.display = 'flex';
		form_avatar_change.submit();
	})
}

	slider.show();

	if(route == "home"){
		load_products('home');
	}
});

//Poductos a mostrar en el inicio//

function load_products(section){
	page_section = section;
	var url = base + '/md/api/load/products/'+page_section+'?page='+page;
	http.open('GET', url, true);
	http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
	http.send();
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			page = page + 1;
			var data = this.responseText;
			data = JSON.parse(data);
			
			if(data.data.length == 0){
				load_more_products.style.display = "none";
			}
			//Funcion cargar productos
			data.data.forEach(function(product, index) {
				products_list_ids_temp.push(product.id);
				var div = "";
				div += "<div class=\"product\">";
					div += "<div class=\"image\">";
						div += "<div class=\"overlay\">";
							div += "<div class=\"btns\">"
								div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Ver\"><i class=\"far fa-eye\"></i></a>";
								div += "<a href=\"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Carrito de compras\"><i class=\"fas fa-shopping-cart\"></i></a>";
								if(auth == "1"){
									div += "<a href=\"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Agregar a favorito\" id=\"favorite_1_"+product.id+"\" onclick=\"add_to_favorites('"+product.id+"', '1'); return false;\"><i class=\"far fa-heart\"></i></a>";
							}else {
								div += "<a href=\"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Agregar a favorito\" id=\"favorite_1_"+product.id+"\" onclick=\"swal.fire({title: 'Oops...', text: 'Hola invitado :D, debes tener una cuenta creada para seleccionar este productos a favoritos.', icon: 'warning'}); return false;\"><i class=\"far fa-heart\"></i></a>";
							}
							div += "</div>";
						div += "</div>"
						div += "<img src=\""+base+"/upload/"+product.file_path+"/t_"+product.image+"\" class=\"img-thumbnail\">";
					div += "</div>";
					div+= "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" title=\""+product.name+"\">";
						div += "<div class=\"title\">"+product.name+"</div>";
						div += "<div class=\"price\">"+currency+product.price+"</div>";
						div += "<div class=\"option\"></div>";
					div+= "</a>";
				div += "</div>";
				products_list.innerHTML += div;
			});

			if(auth == "1"){
				mark_user_favorites(products_list_ids_temp);
				products_list_ids_temp = [];
				console.log(products_list_ids_temp);
			}
		}else{
			// mensaje de error 
		}
	}
}

//Fin de Poductos a mostrar en el inicio//

function mark_user_favorites(objects){
	var url = base + '/md/api/load/user/favorites/';
	var params = 'module=1&objects='+objects;
	http.open('POST', url, true);
	http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.send(params);
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var data = this.responseText;
			data = JSON.parse(data);
			if(data.count > "0"){
				data.objects.forEach(function(favorite, index) { 
					document.getElementById('favorite_1_'+favorite).removeAttribute('onclick');
					document.getElementById('favorite_1_'+favorite).classList.add('favorite_active');
				});
			}
		}
	}
}

//Modulo favoritos//

function add_to_favorites(object, module){
	url = base+'/md/api/favorites/add/'+object+'/'+module;
	http.open('POST', url, true);
	http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
	http.send();
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var data = this.responseText;
			data = JSON.parse(data);
			if(data.status == "success"){
				document.getElementById('favorite_'+module+'_'+object).removeAttribute('onclick');
				document.getElementById('favorite_'+module+'_'+object).classList.add('favorite_active');
			}
		}
	}
}

//Fin modulo favoritos//