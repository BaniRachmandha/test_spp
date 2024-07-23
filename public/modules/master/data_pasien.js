var subapp = {
	table: null,
	form:{
		setattr:function(mode){
			$('.modeutama').html(''+mode+' &nbsp;');
			$('.formnameutama').html(app.get('modulename'));
		},
		mode: function(modename, triggerDOMid) {
			if (triggerDOMid == null)
				return app.getTrigger(modename);
			else $(triggerDOMid).val(app.getTrigger(modename));
		},
		changeform:function(p){
			if(p == 'form'){
				$('#formpage').show(500,'swing');
				$('#gridpage').hide(500,'swing');
			}else{
				$('#formpage').hide(500,'swing');
				$('#gridpage').show(500,'swing');
			}
		},
		add: function() {
			subapp.form.clearform();
			subapp.form.mode('add', '#fmutama input#savemode'); 
			subapp.form.setattr('Tambah');
			subapp.form.changeform('form');
		}, 
		edit: function(id,data) {
			subapp.form.clearform();
			subapp.form.fillform(id,data); 
			subapp.form.mode('edit', '#fmutama input#savemode'); 
			subapp.form.setattr('Edit');	
			subapp.form.changeform('form');
		},
		clearform : function() {
			subapp.data.buffer = null;
			$('#fmutama input').val('');
		},
		fillform : function(id,dt) {
			subapp.data.buffer = dt;
			$('input#nama').val(dt.nama);
			$('#fmutama input#ref').val(app.mask(id));
		},
	},
	rendertable: function() {
		console.log(app.get('serviceurl'));
		var gender=['','Laki-laki','Perempuan'];
		subapp.table = $("#tabelutama").DataTable({
            search: {return: true,},processing: true,serverSide: true,responsive:true,
            order: [[1, 'desc']],
            ajax: {
                url: app.get('serviceurl')+'/grid',
				type:'post'
            },
            columns: [
                { data: 'id'},
                { data: 'no_rm',className:'text-left'},
                { data: 'nm_jns_pasien',className:'text-left'},
                { data: 'nama',className:'text-left'},
                { data: 'nip',className:'text-left'},
                { data: 'gender',className:'text-left'},
                { data: 'ttl',className:'text-left'},
                { data: 'alamat',className:'text-left'},
                { data: 'ìbukandung',className:'text-left'},
                { data: 'nohp',className:'text-left'},
                { data: 'id',className:'text-left'},
            ],
            columnDefs: [
                {
                    targets: 5,data: 'gender',orderable: false,width:'100',
                    render: function (data, type, row) {
                        return gender[data];
                    },
                },{
                    targets: -1,data: 'id',orderable: false,width:'100',
                    render: function (data, type, row) {
                        return '<div class="hstack gap-2">\
                                    <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="13"><i class="ri-delete-bin-5-fill align-bottom"></i></button>\
                                    <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="13"><i class="ri-pencil-fill align-bottom"></i></button>\
                                </div>';  								
                    },
                },
            ],
			initComplete: function(settings, json) {
				$('#tableutama_filter input').unbind();
				$('#tableutama_filter input').bind('keyup', function(e) {
					if(e.keyCode == 13) {
						subapp.grid.search( this.value ).draw();
					}
				});
				$('.dataTable .btn').css('padding', '0 !important');
			}, 
			rowCallback: function(row, data, displayNum, displayIndex, dataIndex) {
				$(row).find('a.btedit').on('click', function() {
					var buttonid = data.id;
					subapp.form.edit(buttonid,data);	
				});
				$(row).find('a.btdelete').on('click', function() {
					var buttonid = data.id;
					subapp.remove(buttonid);	
				});
			}
        })
	}, 

	data: {
		buffer: null,
		form: function() {
			var dt = app.forsend('#fmutama');
			return dt; 
		},
		remove:function(id) {
			var out = {};
			out.id = app.mask(id); 
			out.savemode = app.getTrigger('delete'); 
			return out; 
		},
	},
	save: function() {
		subappx = this;
		let dt = subapp.data.form();
		app.notif.confirm('Konfirmasi', app.confirm.save('data bidang'), function() {
			app.ajax({ type: 'post', dataType:'json',
				url : app.get('serviceurl')+'/save', 
				data: {dt:app.bgks(dt),savemode :dt['savemode']}, 
				beforeSend: function() {
					app.notif.progress('mohon tunggu...');
				}, 
				success: function(resp) {
					app.notif.close();
					app.notif.show(resp.status, resp.title, resp.msg, function() {
						subappx.form.clearform(); 
						subappx.form.changeform('grid');
						subappx.table.ajax.reload();
					});
				}  
			});
		});
	},
	remove: function(id) {
		var subappx = this;
		app.notif.confirm('Konfirmasi', app.confirm.hapus('data'), function() {
			app.ajax({ type: 'post', dataType:'json',
				url : app.get('serviceurl')+'/save', 
				data: subappx.data.remove(id), 
				beforeSend: function() {
					app.notif.progress('mohon tunggu...');
				}, 
				success: function(resp) {
					app.notif.close();
					app.notif.show(resp.status, resp.title, resp.msg, function() {
						subappx.form.clearform(); 
						subappx.table.ajax.reload();
					});
				}  
			});
		});
	},
	init:function(){
		app.init('appfooterdata');
		// $('.mn-wilayah').addClass('here').addClass('show');
		$('.mn-bidang').addClass('active');
		subapp.rendertable();
		
		$('#fmutama').on('submit', function(e) {
			e.preventDefault();
			if($('#nama').val() == ''){
				return app.notif.show('error','ERROR','Nama Belum Diisi');
			}
			subapp.save();
		});
		$('.btaddnew').on('click',function(){
			subapp.form.add();
		})
		$('.btbatal').on('click',function(){
			subapp.form.changeform('grid');
		})
	}
}

$(function() {
	subapp.init();
});
