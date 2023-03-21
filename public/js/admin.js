/// <reference path="../../typings/globals/jquery/index.d.ts" />

// const { ajax } = require("jquery");

// const { result } = require("lodash");
function ajaxSorting (roles, perms, el, data1, data2, data3) {
    console.log(data1)
    $.ajax({
        url: el.data('url'),
        type: 'get',
        data: {
            userNameSort: data1,
            emailSort: data2,
            roleSort: data3,
            role_id: roles,
            permission_id: perms,
            search: $('#hidden_search').val(),
        },
        dataType: 'json',
        success: function(res) {
            console.log(res)
            el.find('i').remove();
            if (el.data('sort') == 'asc') {
                $('<i class="fa-solid fa-arrow-down-a-z"></i>').appendTo(el)
                el.data('sort', 'desc')
            } else if(el.data('sort') == 'desc') {
                $('<i class="fa-solid fa-arrow-up-a-z"></i>').appendTo(el)
                el.data('sort', 'asc')
            }
            $('#list').empty();
            $(res.list).appendTo('#list');
            $('#pagination').remove();
            $(res.pagination).appendTo('#container-fluid');
            res = null;
        },
        error: function(err) {
            console.log(err)
        }
    })
}
$(document).ready(function() {
    let roles = []
    let perms = []
    function fill_perms_roles() {
        $.each($('.roles'), function (key, val) {
            roles[key] = $('.roles').eq(key).val()
        })
        $.each($('.perms'), function (key) {
            perms[key] = $('.perms').eq(key).val()
        })
    }
    $(document).on("click", ".show-modal",function(e) {
        // console.log(e)
        $($(this).data('id')).modal('show');
    })
    $(document).on("click", "[data-dismiss=modal]", function() {
        $(this).closest('.modal').modal('toggle')
    })
    $('#sortUserName').click(function(e) {
        e.preventDefault();
        roles = []
        perms = []
        fill_perms_roles()
        let el = $(this);
        let data = $(this).data('sort')
        ajaxSorting(roles, perms, el, data, null, null)
    })
    $('#sortEmail').click(function(e) {
        e.preventDefault();
        roles = []
        perms = []
        fill_perms_roles()
        let el = $(this);
        let data = $(this).data('sort')
        ajaxSorting(roles, perms, el, null, data, null)
    })
    $('#sortRole').click(function(e) {
        e.preventDefault();
        roles = []
        perms = []
        fill_perms_roles()
        let el = $(this);
        let data = $(this).data('sort')
        ajaxSorting(roles, perms, el, null, null, data)
    })
    $('button.modal-show').click(function() {
        $($(this).data('modal')).modal('show');
    })
    $('button.modal-close').click(function() {
        $($(this).data('modal')).modal('toggle');
    })
    $('#filter').submit(function(e) {
        e.preventDefault()
        $(this).ajaxSubmit({
            success: function(res) {
                $('#list').empty();
                $(res.list).appendTo('#list');
                $('#pagination').remove();
                $(res.pagination).appendTo('#container-fluid');
                $('#hidden_filter').empty();
                $.each(res.get_roles, function(key, val) {
                    $('<input form="search" class="roles" name="role_id[]" type="hidden" value='+ res.get_roles[key] +'>').appendTo('#hidden_filter')
                })
                $.each(res.get_perms, function(key, val) {
                    $('<input form="search" class="perms" name="permission_id[]" type="hidden" value="'+ res.get_perms[key] +'">').appendTo('#hidden_filter')
                })
            },
            error: function(res) {
                console.log(res)
            }
        })
    })
    $('form.editRole').submit(function(e) {
        e.preventDefault();
        let modal = $(this).parent().parent().parent();
        $(this).ajaxSubmit({
            beforeSend: function() {
                modal.modal('toggle');
            },
            success: function(res) {
                console.log(res.perms);
                let div = $('#RolePermissionsShow' + res.role_id);
                div.empty();
                if (res.perms.length > 0) {
                    $.each(res.perms, function(key, val){
                        $('<p>'+ val.permission_name +'<p>').appendTo(div);
                    })
                }
                else {
                    $('<p>Нет прав<p>').appendTo(div);
                }
                modal.modal('hide');
            },
            error: function(err) {
                console.log(err);
            }
        })
    })
})