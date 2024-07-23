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
        },
        fillform: function(id, dt) {
            subapp.data.buffer = dt;
            $('input#jdltemplate').val(dt.jdl_template);
            $('textarea#desktemplate').val(dt.desktemplate);
            $('input#datecreate').val(dt.cd);
            $('input#idfile').val(dt.id_files);
            $('input#jnsfile').val(dt.jnsfile);
            $('textarea#kettemplate').val(dt.kettemplate);
            $('#fmutama input#ref').val(app.mask(id));
			var btndownload = '<button class="btn btn-success btn-sm" onclick="subapp.download('+dt.id_files+')" type="button">' +dt.realname+ '</button>';
            $('#formpage .filediv').html(btndownload);            
        },
    },
    upload: function() {
        var d = new FormData();
        d.append('filenya', $('#formpage #filetemplate')[0].files[0]);
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
                { data: 'jdl_template', className: 'text-left' },
                { data: 'desktemplate', className: 'text-left' },
                { data: 'datecreate', className: 'text-left' },
                { data: 'jnsfile', className: 'text-left' },
                { data: 'kettemplate', className: 'text-left' },
                //{ data: 'id', className: 'text-left' },
            ],
            columnDefs: [
                {
                    targets: 0,
                    data: 'id',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<div class="hstack gap-2">\
                                    <button class="btn btn-sm btn-soft-danger btdelete"><i class="ri-delete-bin-5-fill align-bottom"></i></button>\
                                    <button class="btn btn-sm btn-soft-info btedit"><i class="ri-pencil-fill align-bottom"></i></button>\
                                    <button class="btn btn-sm btn-soft-primary btdownload"><i class="ri-download-fill align-bottom"></i></button>\
                                </div>';
                    }
                },
                {
                    targets: 4,
                    data: 'jdl_info',
                    orderable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return '<span class="badge border border-primary text-primary">'+data+'</span>';
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
            out.jdltemplate = $('#fmutama input#jdltemplate').val();
            out.desktemplate = $('#fmutama textarea#desktemplate').val();
            out.datecreate = $('#fmutama input#datecreate').val();
            out.idfile = $('#fmutama input#idfile').val();
            out.jnsfile = $('#fmutama input#jnsfile').val();
            out.kettemplate = $('#fmutama textarea#kettemplate').val();
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
        app.notif.confirm('Konfirmasi', app.confirm.save('data template penulisan'), function() {
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
            subapp.form.changeform('grid');
        })
    }
}

$(function() {
    subapp.init();
});