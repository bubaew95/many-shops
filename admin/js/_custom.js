const spinner = (
    `<div class="loadingio-spinner-double-ring-hsf1x3trzku d-flex justify-content-center">
        <div class="ldio-xopg5s16mug">
            <div></div>
            <div></div>
        </div>
    </div>`
);

$(function () {

    $(document).on('change', '#change-status', function() {
        if(!confirm('Вы уверены что хотите изменить статус?')) return;
        let id   = $(this).data('id')
        let s_id = $(this).val();
        let mUrl = $(this).data('url');
        $.post({
            url: mUrl,
            data: {id: id, s_id: s_id},
            dataType: 'json',
            beforeSend: function () {
                console.log('beforeSend')
            },
            success: function (data) {
                if(data === 'success') {
                    window.location.reload();
                }
            },
            error: function(err) {
                alert('Ошибка: ' + err.responseText,);
            }
        });
        console.log();
    });

    $(document).on('change', '#menu-page_id', function () {
        let val     = $(this).val();
        let field   = $('#menu-link').parent();
        if(val == 'null') {
            field.show();
        } else {
            field.hide();
        }
    })

    $(document).on('click', '.popap', function (e) {
        e.preventDefault();
        let mUrl = $(this).attr('href');
        let modal = Modal.large();
        $.get({
            url: mUrl,
            beforeSend: function () {
                modal.content(spinner)
            },
            success: function (data) {
                modal.content(data)
            },
            error: function (err) {
                modal.content(err.responseText)
            }
        });
        modal.show();
    });

    /**
     * Создание и изменение CRUD
     */
    $(document).on('submit', '#checkForm', (e) => {
        e.preventDefault();
        return false;
    }).on('beforeSubmit', '#checkForm', function (e) {
        e.preventDefault();
        let form    = $(this);
        let mUrl    = $(this).attr('action');
        let mData   = $(this).serialize();
        let btnSend = form.find('[type="submit"]');

        $.post({
            url: mUrl,
            data: mData,
            dataType: 'json',
            beforeSend: function () {
                btnSend.attr('disabled', true);
                console.log('send');
            },
            success: function (data) {
                console.log(data)
                btnSend.attr('disabled', false);
                if(data.success) {
                    window.location.reload();
                } else if (data.validation) {
                    let error = data.errors;
                    let errorTxt = '';

                    error.map((item) => {
                        errorTxt += `${item[0]}<br>`;
                    });

                    form.yiiActiveForm('updateMessages', data.validation, true);
                } else {
                    alert('Неизвестная ошибка');
                }
            },
            error: function (err) {
                alert('Ошибка: ' + err.responseText,);
            }
        })
    });

});

class Modal {
    static properties = {
        modalDom:    $('#modal'),
        modalDialog: $('.modal-dialog'),
        modalTitle:  $('.modal-header h2'),
        modalFooter: $('.modal-footer'),
        modalBody:   $('.modal-body')
    };

    static large() {
        this.properties.modalDialog.addClass('modal-lg');
        return this;
    }

    static show() {
        this.properties.modalDom.modal('show');
        return this;
    }

    static hide() {
        this.properties.modalDom.modal('hide');
        return this;
    }

    static title(title) {
        this.properties.modalTitle.text(title);
        return this;
    }

    static content(data) {
        this.properties.modalBody.empty().append(data);
        return this;
    }
}
