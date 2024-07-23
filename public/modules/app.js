var app = {
	shortmonth: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
	longmonth: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
	numbermonth: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
	
	formatrupiah:function(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	},
	setUrl:function(suburl) {
		return app.get('base') +'index.php/'+suburl;
	},
	siteUrl: function() {
		return app.get('base') +'index.php/';
	},
	goUrl:function(url) {
		location.href=url;
	},
	openUrl: function(url) {
		window.open(url);
	},
	previousUrl: function() {
		history.back();
	},
	mask:function(id) {
		var maskref = JSON.parse(app.get('maskref')); 
		return maskref[0]+ id + maskref[1];
	},
	getTrigger:function(mode) {
		var trigger = JSON.parse(app.get('trigger'));
		return trigger[mode]; 
	},
	init : function(source) {
		this.reset();
		/* mandatory items : base, token */
		var out = false;
		var encdata = $('#'+ source).html();
		if (encdata == '') return out;
		var itemlist = JSON.parse(atob(encdata));
		var kys = Object.keys(itemlist);
		kys.forEach(function(v, i) {
			localStorage.setItem(btoa(v),btoa(itemlist[v]));
		});
		localStorage.setItem(btoa('lkys'),btoa(JSON.stringify(kys)));
		out = true;
		//$('#'+source).html('');
		return out;
	}, 
	set: function(param, val) {
		localStorage.setItem(btoa(param),btoa(val));
	}, 
	get: function(param) {
		return atob(localStorage.getItem(btoa(param)));
	},
	reset: function() {
		var safeparam = ['debugbar-time', 'debugbar-time-new', 'data-bs-theme'];
		var out = [];
		for (var i=0; i< safeparam.length; i++) {
			out.push(localStorage.getItem(safeparam[i])); 
		}
		localStorage.clear();
		for (var k=0; k < safeparam.length; k++) {
			localStorage.setItem(safeparam[k], out[k]);
		}
	},
	notif: {
		show: function(status, title, message, onok) {
			var arstat = {info:'success', error:'error', warning:'warning'};
			Swal.fire({
				title: title,
				html: message,
				icon: arstat[status],
				buttonsStyling: false,
				confirmButtonText: "OK",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			}).then((result) => {
				if (typeof onok == 'function') {
					onok();
				}
			});
		}, 
		confirm: function(title, message, onok) {
			Swal.fire({
			  title: title,
			  text: message,
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya', 
			  cancelButtonText: 'Tidak', 
			}).then((result) => {
			  if (result.isConfirmed) {
				if (typeof onok == 'function') {
					onok();
				}
			  }
			});
		},
		progress: function(msg) {
			var myval = 1;
		    var persen = 0;
		    Swal.fire({
		      html: '<div class="progress bg-light" style="height:30px">' +
		                    '<div id="progressbarstatusapp" ' +
		                    'class="progress-bar bg-primary text-white progress-bar-striped progress-bar-animated" ' +
		                    'role="progressbar" aria-valuenow="' + myval + '" aria-valuemin="0" ' +
		                    'aria-valuemax="100" style="width: ' + persen + '%;">' +
		                    '<span style="font-size:11pt">' + msg + '</span> </div></div>',
		      showConfirmButton:false,
		      allowOutsideClick: false, 
		      title:'Loading...', 
		    });
		    var runprogress = setInterval(function () {
		        persen = myval * 10;
		        if (persen == 100) {
		            clearInterval(runprogress);
		        }
		        $('#progressbarstatusapp').css('width', persen + '%');
		        myval++;
		    }, 500);
			
		}, 
		close: function() {
			Swal.close();
		},
		gourl:function(){
			notif.progress('Mohon tunggu...');
	    	setInterval(function(){window.location = url}, 1500);
		}
	},
	ajax: function(options){
		$.ajax(options);
		return options;
	},
	confirm: {
		hapus: function(data) { return 'Anda yakin untuk menghapus '+data+' ini?' }, 
		edit: function(data) { return 'Anda yakin untuk mengubah '+data+' ini?' }, 
		save: function(data) { return 'Anda yakin untuk menyimpan '+data+' ini?' }, 
		revisi: function(data) { return 'Anda yakin untuk merevisi '+data+' ini?' }, 
		kirim: function(data) { return 'Anda yakin untuk mengirim '+data+' ini?' }, 
		kembalikan: function(data) { return 'Anda yakin untuk mengembalikan '+data+' ini?' }, 
	},
	removedotstr:function(el) {
		var x = el.replace(/\./g,'');
		return x;
	},

	removecomastr:function(el) {
		var x = el.replace(/\,/g,'.');
		return x;
	},

	joincomastr:function(el) {
		var x = el.replace(/\./g,',');
		return x;
	},
	numberformat: function(number) {
		return new Intl.NumberFormat('id-ID').format(number);
	}, 
	date: function(tgl, format) { //format: 'long', 'short', 'number'
		var idbulan,day,separator;
		var d = new Date(tgl);
		switch(format) {
			case 'long' : idbulan = this.longmonth[d.getMonth()]; 
						  separator = ' '; break; 
			case 'short' : idbulan = this.shortmonth[d.getMonth()]; 
						  separator = '-'; break;
			default : idbulan = this.numbermonth[d.getMonth()]; 
						  separator = '-'; break;
		}
		day = d.getDate(); 
		if (day.toString().length < 2) day = '0'+day;
		var str = day+separator+idbulan+separator+d.getFullYear();
		return str;
	}, 
	time: function(tgl) {
		var d = new Date(tgl);
		var s = function(content)  {
			if (content.toString().length < 2) return '0'+content;
			return content;
		}
		var out = s(d.getHours())+':'+s(d.getMinutes())+':'+s(d.getSeconds());
		return out;
	},

	numberonly:function(angka,event){
		angka.replace(/[^0-9\.]/g,'');
        if ((event.which != 46 || angka.indexOf('.') != -1) && (event.which < 48 || event.which > 57 )) {
            event.preventDefault();
        }
	},
	numbercommapoint:function(angka,event){
		angka.replace(/[^0-9\.]/g,'');
        if ((event.which != 46 || angka.indexOf('.') != -1) && (angka.indexOf(',') != -1) && (event.which < 48 || event.which > 57 )) {
            event.preventDefault();
        }
	},
	numberdecimal:function(angka,event){
	    angka.replace(/[^\d].+/, "");
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
	},

	forsend:function(formname){
		dt = {};
	    var inputsemua = formname+" textarea," + formname+" input,"+ formname+" select"
	    $(inputsemua).each(function(){
	        dt[this.id] = this.value;
	    });
	    return dt
	},

	bgks:function(dt){
		return btoa(JSON.stringify(dt));
	},
}

$(document).ready(function(){
	app.init('appfooterdata');
})
