
	var list_show;
	var site_url,inx,base_url;
	var kategori=[];
	var kat_menu=[];
	var restoran=[];

function parse_variable(arr){
		site_url=arr['su'];
		inx=arr['inx'];
		base_url=arr['bu'];
		kategori=arr['kat'];
		restoran=arr['res'];
	}

function foto_menu(file){
	var url=base_url+'assets/image/menu/'+file;
	document.getElementById('img-modal').setAttribute('src',url);
}
function foto_restoran(file){
	var url=base_url+'assets/image/restoran/'+file;
	document.getElementById('img-modal').setAttribute('src',url);
}

function hapus_restoran(id,nama){
	document.getElementById('hapus_id_restoran').value=id;
	document.getElementById('hapus-restoran').innerHTML=nama;
}
function hapus_menu(id,nama){
	document.getElementById('hapus_id_menu').value=id;
	document.getElementById('hapus-menu').innerHTML=nama;
}
function edit_kategori(id,nama){
	document.getElementById('edit_id_kategori').value=id;
	document.getElementById('edit_nama_kategori').value=nama;
}

function edit_restoran(arr){
	var html='<option value="'+arr.kategori+'">'+kategori[arr.kategori]+'</option>';
	for (key in kategori) {
		if(key!=arr.kategori){
			html += '<option value="'+key+'">'+kategori[key]+'</option>';
		}
	}
	var sl=document.getElementById('edit_rating').getAttribute('data-slider-value');
	document.getElementById('edit_id_restoran').value=arr.id_restoran;
	document.getElementById('edit_nama_restoran').value=arr.nama_restoran;
	document.getElementById('edit_kategori_restoran').innerHTML = html;
	var rating=parseInt(arr.rating)/2;
	document.getElementById('edit_rating').value=rating;
	document.getElementById('edit_keterangan_restoran').innerHTML = arr.keterangan;
	var url=base_url+'assets/image/restoran/'+arr.foto;
	document.getElementById('edit-view-restoran').setAttribute('src',url);
	$('#upload-restoran').children().hide();
	$('#ubah-restoran').on("change", function(){
		var checked=$('#ubah-restoran').is(":checked");
		if(checked){
			$('#upload-restoran').children().show();
		}else{
			$('#upload-restoran').children().hide();
			document.getElementById('edit-view-restoran').setAttribute('src',url);
		}
	});
}

function edit_menu(arr){
	var html='<option value="'+arr.kategori+'">'+kategori[arr.kategori]+'</option>';
	for (key in kategori) {
		if(key!=arr.kategori){
			html += '<option value="'+key+'">'+kategori[key]+'</option>';
		}
	}
	var op_res='<option value="'+arr.restoran+'">'+restoran[arr.restoran]+'</option>';
	for (r in restoran) {
		if(r!=arr.restoran){
			op_res += '<option value="'+r+'">'+restoran[r]+'</option>';
		}
	}
	var sl=document.getElementById('edit_rating').getAttribute('data-slider-value');
	document.getElementById('edit_id_menu').value=arr.id_menu;
	document.getElementById('edit_nama_menu').value=arr.nama_menu;
	document.getElementById('edit_kategori_menu').innerHTML = html;
	document.getElementById('edit_restoran_menu').innerHTML = op_res;
	document.getElementById('edit_keterangan_menu').innerHTML = arr.keterangan;
	var url=base_url+'assets/image/menu/'+arr.foto;
	document.getElementById('edit-view-menu').setAttribute('src',url);
	$('#upload-menu').children().hide();
	$('#ubah-menu').on("change", function(){
		var checked=$('#ubah-menu').is(":checked");
		if(checked){
			$('#upload-menu').children().show();
		}else{
			$('#upload-menu').children().hide();
			document.getElementById('edit-view-menu').setAttribute('src',url);
		}
	});
}

function readURL(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        }
    	reader.readAsDataURL(input.files[0]);
    }
}