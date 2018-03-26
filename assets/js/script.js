
	$('#detail-restoran').children().hide();
	$('#filter-menu').children().hide();
		$('#filter-menu').hide();


	var list_show;
	var site_url,inx,base_url;
	var kategori=[];
	var kat_menu=[];
	// var kat_res=[];

	function parse_variable(arr){
		site_url=arr['su'];
		inx=arr['inx'];
		base_url=arr['bu'];
		k=arr['kat'];
		kat_res=arr['kat'];
		for (var i = 0; i < k.length; i++) {
			var id=k[i]['id_kategori'];
			kategori[id]=k[i]['nama_kategori'];
		}
	}

	function detail(x){
		var id='list_'+x;
		var list=$('[name=restoran]');
		list_show=id;
		var link=site_url+'/Restoran/detail_restoran/';
		for (var i = 0; i < list.length; i++) {
			var id_restoran=list[i].getAttribute('id');
			if(id_restoran != id ){
				$('#'+id_restoran).children().hide();
				$('#'+id_restoran).hide();
			}
			$('#detail-restoran').children().show();
		}
		$.get(link,{nama:x},function(data){
				document.getElementById('detail-restoran').innerHTML=data;
			});
		get_menu(x);
		kategori_menu(x);
	}

	function close_detail(){
		$('#detail-restoran').children().hide();
		var list=$('[name=restoran]');
		for (var i = 0; i < list.length; i++) {
			var id_restoran=list[i].getAttribute('id');
			if(id_restoran != list_show ){
				$('#'+id_restoran).children().show();
				$('#'+id_restoran).show();
			}
			// $('.menu').children().hide();
		}
	}

	function filter(){
		var kat = $('#filter').val();
		$('#detail-restoran').children().hide();
		
		for(k in kategori){
			if(k!=kat&&kat!='semua'){
				$('.'+k).children().hide();
				$('.'+k).hide();
			}else if(kat=='semua'){
				$('.'+k).children().show();
				$('.'+k).show();
			}else{
				$('.'+k).children().show();
				$('.'+k).show();
			}
		}
	}

	function filter_menu(){
		var kat = $('#filter-menu').val();
		for (var i = 0; i < kat_menu.length; i++) {
			var k='menu-'+kat_menu[i];
			if(k!=kat&&kat!='semua'){
				$('.'+k).children().hide();
				$('.'+k).hide();
			}else if(kat=='semua'){
				$('.'+k).children().show();
				$('.'+k).show();
			}else{
				$('.'+k).children().show();
				$('.'+k).show();
			}
		}
	}

	function get_menu(x){
		var link=site_url+'/Restoran/menu_restoran/';
		$.get(link,{nama:x},function(data){
				document.getElementById('menu-restoran').innerHTML=data;
			});
	}
	function kategori_menu(x){
		$('#filter-menu').children().show();
		$('#filter-menu').show();
		var link=site_url+'Restoran/kategori_menu/';
		$.get(link,{nama:x},function(data){
				data=JSON.parse(data);
				document.getElementById('filter-menu').innerHTML=data.html;
				kat_menu=data.d;
			});
	}

	function detail_menu(x){
		var link=site_url+'/Restoran/detail_menu/';
		$.get(link,{id_menu:x},function(data){
				data=JSON.parse(data);
				var foto=base_url+'assets/image/menu/'+data.img;
				document.getElementById('menu-nama').innerHTML=data.nama;
				document.getElementById('menu-img').setAttribute('src',foto);
				document.getElementById('menu-keterangan').innerHTML=data.keterangan;
			});
	}
