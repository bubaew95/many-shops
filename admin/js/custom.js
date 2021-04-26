'use strict';
/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
const server    = new MyClass();
var reloadPage  = false;

/**
 * Получение окна
 * @param URL
 * @returns {Promise<void>}
 */
const loadModalData = async  (URL) => {
    server.modalAppend(spinner);

    await server.getResource({url: URL})
        .then(data => {
            server.modalAppend(data);
        }).catch(err => {
            server.notify('Ошибка', err, 'bg-danger border-danger')
        });
}

/**
 * Обновленеие данных на сервере и релоад окна
 * @param currentTarget
 * @param data
 * @param method
 * @param editurl
 * @returns {Promise<void>}
 */
const queryOnServer = async ({ currentTarget, data, method, editurl}) => {
    server.btnLoading( $(currentTarget), true);
    await server.getResource({url: currentTarget.href, body: data, method: method, format: 'json'})
        .then( data => {
            if(data.errors) {
                server.notify('Ошибка', data.errors, 'bg-danger border-danger')
            } else {
                reloadPage = true;
                server.notify('', data.msg)
                loadModalData(editurl);
            }
        }).catch((err) => {
            server.notify('Ошибка', err, 'bg-danger border-danger')
        });
    server.btnLoading($(currentTarget), false);
}

$(function () {
    /**
     * Модальное окно
     */
    $(document).on('click', '.popap', async (e) => {
        e.preventDefault();
        let URL = e.currentTarget.href;
        let DOM_OBJECT = $(e.currentTarget);
        let modalSize = DOM_OBJECT.data('modal');

        if(typeof modalSize !== 'undefined') {
            MODAL_DIALOG.addClass('modal-lg')
        }

        MODAL.modal({
            keyboard: true,
            show: true
        });

        await loadModalData(URL);
    });

    const serializeFiles = function(formDom) {
        const formData = new FormData();
        formData.append('key1', 'value1');
        formData.append('key2', 'value2');
        const formParams = formDom.serializeArray();
        console.log('ds', formParams);
        $.each(formDom.find('input[type="file"]'), function(i, tag) {
            formData.append(tag.name, tag.value);
        });
        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        formData.append('asfas', 'sadgfasdg3');
        console.log('dsss', formData );
        return formData;
    };

    /**
     * Создание и изменение CRUD
     */
    $(document).on('submit', '#checkForm', (e) => {
        e.preventDefault();
        return false;
    })
    .on('beforeSubmit', '#checkForm', async (e) => {
        e.preventDefault();
        reloadPage    = false;
        const FORM_DOM  = $(e.currentTarget);
        const URL       = e.currentTarget.action;
        const DATA      = FORM_DOM.serialize();
        const METHOD    = 'POST';
        server.btnLoading(FORM_DOM.find('.btn-loading'), true);

        await server.getResource({url: URL, body: DATA, method: METHOD, format: 'json'}).then( data => {
            if(data.success) {
                server.notify(data.status  ? 'Новая запись успешно создана' : 'Данные обновлены');
                if(data.status) {
                    window.location.reload();
                } else reloadPage = true;
            } else if (data.validation) {
                let error = data.errors;
                let errorTxt = '';

                error.map((item) => {
                    errorTxt += `${item[0]}<br>`;
                });

                server.notify('Ошибка', errorTxt, 'bg-danger border-danger')
                FORM_DOM.yiiActiveForm('updateMessages', data.validation, true);
            } else {
                server.notify('Ошибка', data.errors, 'bg-danger border-danger')
            }
        }).catch((err) => {
            server.notify('Ошибка', err, 'bg-danger border-danger')
        });

        server.btnLoading(FORM_DOM.find('.btn-loading'), false);
    });

    /**
     * Отправить данные в DialogFlow
     */
    $(document).on('click', '.btn-send',  async (e) => {
        e.preventDefault();
        reloadPage      = false;
        const FORM_DOM  = $(e.currentTarget);
        const URL       = e.currentTarget.href;
        const METHOD    = 'POST';
        const DATA      = `${csrfParam}=${csrfToken}`;

        const {dataset: { action } } = e.target;

        if( action === 'delete' &&
            !confirm("Вы уверены, что хотите удалить?")
        ) return false;

        server.btnLoading(FORM_DOM, true);

        await server.getResource({url: URL, body: DATA, method: METHOD, format:'json' }).then( data => {
            if(data.success) {
                server.notify(data.msg);
            } else if(data.status){
                server.notify('Ошибка', data.message, 'bg-danger border-danger')
            } else {
                server.notify('Ошибка', data.errors, 'bg-danger border-danger')
            }
        }).catch((err) => {
            server.notify('Ошибка', err, 'bg-danger border-danger')
        });

        server.btnLoading(FORM_DOM, false);
    });

    /**
     * Работа с модальным окном
     */
    MODAL.on('hidden.bs.modal', (e) => {
        if(reloadPage) window.location.reload();
    })
})

$(function () {
    $('[title="Просмотр"]').addClass('btn-warning');
    $('[title="Изменить"]').addClass('btn-info');
    $('[title="Удалить"]').addClass('btn-danger');
})