var subapp = {
    table: null,
    form: {
        setattr: function(mode) {
            $('.modeutama').html('' + mode + ' &nbsp;');
            $('.formnameutama').html(app.get('modulename'));
        },
        mode: function(modename, triggerDOMid) {
            if (triggerDOMid == null)
                return app.getTrigger(modename);
            else $(triggerDOMid).val(app.getTrigger(modename));
        },
        changeform: function(p) {
            if (p == 'form') {
                $('#formpage').show(500, 'swing');
                $('#gridpage').hide(500, 'swing');
            } else {
                $('#formpage').hide(500, 'swing');
                $('#gridpage').show(500, 'swing');
            }
        },
        add: function() {
            subapp.form.clearform();
            subapp.form.mode('add', '#fmutama input#savemode');
            subapp.form.setattr('Tambah');
            subapp.form.changeform('form');
        },

        edit: function(id, data) {
            subapp.form.clearform();
            subapp.form.fillform(id, data);
            subapp.form.mode('edit', '#fmutama input#savemode');
            subapp.form.setattr('Edit');
            subapp.form.changeform('form');
        },
        clearform: function() {
            subapp.data.buffer = null;
            $('#fmutama input, #fmutama textarea').val('');
            $('#formpage .filediv').html('');
            $('#idprodi').val(null).trigger('change');
        },
        fillform: function(id, dt) {
            console.log(dt);
            subapp.data.buffer = dt;
            $('input#nim').val(dt.nim);
            $('input#namamhs').val(dt.namamhs);
            $('#idprodi').val(dt.prodi).trigger("change");
            $('textarea#jdl_skripsi').val(dt.jdl_skripsi);
            $('input#dospem').val(dt.dospem);            
            $('input#sempro').val(dt.sempro);            
            $('input#sidang').val(dt.sidang);            
            $('input#revisi').val(dt.revisi);            
            $('input#nilaiskripsi').val(dt.nilaiskripsi);            
            $('input#datecreate').val(dt.cd);
            $('input#idfile').val(dt.id_files);
            $('#fmutama input#ref').val(app.mask(id));
			var btndownload = '<button class="btn btn-success btn-sm" onclick="subapp.download('+dt.id_files+')" type="button">' +dt.realname+ '</button>';
            $('#formpage .filediv').html(btndownload);            
        },
    },
    dropdown: {
        listprodi: function() {
            app.ajax({
                type: 'post',
                dataType: 'json',
                url: app.get('serviceurl') + '/listprodi',
                success: function(resp) {
                    //console.log(resp)
                    var opt='<option value="0"></option>';
                    for (var i = 0;i<resp.length; i++) {
                        var dt=resp[i];
                        opt +='<option value="'+dt.id+'">'+dt.nm_prodi+'</option>'
                    }
                    $('#fmutama select#idprodi').html(opt);
                    $('#fmutama select#idprodi').select2().trigger('change');
                }
            });
        },
    },
    upload: function() {
        var d = new FormData();
        d.append('filenya', $('#formpage #filehasilskripsi')[0].files[0]);
        d.append('savemode', app.getTrigger('upload'));
        app.ajax({
            type: 'post',
            url: app.get('suburl') + '/upload/' + app.get('token'),
            data: d,
            contentType: false,
            processData: false,
            beforeSend: function() {
                app.notif.progress('mohon tunggu...');
            },
            success: function(resp) {
                app.notif.close();
                res = JSON.parse(resp);
                $('#formpage .idfile').val(res.msg.id_file);
                var btndownload = '<button class="btn btn-success btn-sm" onclick="subapp.download('+res.msg.id_file+')" type="button">' + res.msg.name + '</button>';
                $('#formpage .filediv').html(btndownload);
                // id_files:res.msg.id_file, 
                // realname:res.msg.name,				
            }
        });
    },
    download: function(id) {
        app.openUrl(app.get('suburl') + '/download/' + app.get('token') + '/' + app.mask(id));
    },
    rendertable: function() {
        console.log(app.get('serviceurl'));
        var gender = ['', 'Laki-laki', 'Perempuan'];
        subapp.table = $("#tabelutama").DataTable({
            search: { return: true, },
            processing: true,
            serverSide: true,
            responsive: false,
            order: [
                [0, 'desc']
            ],
            ajax: {
                url: app.get('serviceurl') + '/grid',
                type: 'post'
            },
            columns: [
                { data: 'id' },
                { data: 'nim', className: 'text-left' },
                { data: 'namamhs', className: 'text-left' },
                { data: 'nm_prodi', className: 'text-left' },
                { data: 'jdl_skripsi', className: 'text-left text-wrap' },
                { data: 'dospem', className: 'text-left' },
                { data: 'sempro', className: 'text-left' },
                { data: 'sidang', className: 'text-left' },
                { data: 'revisi', className: 'text-left' },
                { data: 'nilaiskripsi', className: 'text-left text-wrap' },
                //{ data: 'id', className: 'text-left' },
            ],
            columnDefs: [
                {
                    targets: 0,
                    data: 'id',
                    orderable: false,
                    width: '70',
                    render: function(data, type, row) {
                        return '<div class="hstack gap-2">\
                                        <button class="btn btn-sm btn-soft-danger btdelete"><i class="ri-delete-bin-5-fill align-bottom"></i></button>\
                                        <button class="btn btn-sm btn-soft-info btedit"><i class="ri-pencil-fill align-bottom"></i></button>\
                                    </div>';
                    }
                },
                {
                    targets: 6,
                    data: 'jdl_info',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<span class="badge border border-primary text-primary">'+data+'</span>';
                    },                
                },
                {
                    targets: 7,
                    data: 'jdl_info',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<span class="badge border border-primary text-primary">'+data+'</span>';
                    },                
                }, 
                {
                    targets: 8,
                    data: 'jdl_info',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<span class="badge rounded-pill bg-primary">'+data+'</span>';
                    },                
                },
                {
                    targets: 9,
                    data: 'jdl_info',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<b><span class="fs-14">'+data+'</span></b>';
                    },                
                },                                                
            ],
            initComplete: function(settings, json) {
                $('#tableutama_filter input').unbind();
                $('#tableutama_filter input').bind('keyup', function(e) {
                    if (e.keyCode == 13) {
                        subapp.grid.search(this.value).draw();
                    }
                });
                $('.dataTable .btn').css('padding', '0 !important');
            },
            rowCallback: function(row, data, displayNum, displayIndex, dataIndex) {
                $(row).find('button.btedit').on('click', function() {
                    var buttonid = data.id;
                    subapp.form.edit(buttonid, data);
                });
                $(row).find('button.btdelete').on('click', function() {
                    var buttonid = data.id;
                    subapp.remove(buttonid);
                });
                $(row).find('button.btdownload').on('click', function() {
                    var buttonid = data.id_files;
                    subapp.download(buttonid);
                });                
            }
        })
    },

    data: {
        buffer: null,
        form: function() {
        	var out = {};
            out.id = $('#fmutama input#ref').val();
            //out.savemode = $('#fmutama input.savemode').val();
            out.nim = $('#fmutama input#nim').val();
            out.namamhs = $('#fmutama input#namamhs').val();
            out.prodi = $('#fmutama #idprodi').find("option:selected").val();
            out.jdl_skripsi = $('#fmutama textarea#jdl_skripsi').val();
            out.dospem = $('#fmutama input#dospem').val();         
            out.sempro = $('#fmutama input#sempro').val();            
            out.sidang = $('#fmutama input#sidang').val();            
            out.revisi = $('#fmutama input#revisi').val();            
            out.nilaiskripsi = $('#fmutama input#nilaiskripsi').val();            
            out.idfile = $('#fmutama input#idfile').val();
            return out;
        },
        remove: function(id) {
            var out = {};
            out.id = app.mask(id);
            out.savemode = app.getTrigger('delete');
            return out;
        },
    },
    save: function() {
        subappx = this;
        let dt = subapp.data.form();
        app.notif.confirm('Konfirmasi', app.confirm.save('data Monitoring Sidang'), function() {
            app.ajax({
                type: 'post',
                dataType: 'json',
                url: app.get('serviceurl') + '/save',
                data: { dt: app.bgks(dt), savemode: $('#fmutama input#savemode').val()},
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
            app.ajax({
                type: 'post',
                dataType: 'json',
                url: app.get('serviceurl') + '/save',
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
    init: function() {
        app.init('appfooterdata');
        // $('.mn-wilayah').addClass('here').addClass('show');
        $('.mn-bidang').addClass('active');
        subapp.rendertable();
        $('#fmutama select#idprodi').select2();
        subapp.dropdown.listprodi();

        $('#fmutama').on('submit', function(e) {
            e.preventDefault();
            if ($('#nama').val() == '') {
                return app.notif.show('error', 'ERROR', 'Nama Belum Diisi');
            }
            subapp.save();
        });
        $('.btaddnew').on('click', function() {
            subapp.form.add();
        })
        $('.btbatal').on('click', function() {
            subapp.form.clearform();
            subapp.form.changeform('grid');
        })
    }
}

$(function() {
    subapp.init();
});