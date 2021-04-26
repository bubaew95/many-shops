var MODAL = $('#modal');
var MODAL_DIALOG = $('.modal-dialog');
var MODAL_TITLE = $('.modal-header');
var MODAL_BODY = $('.modal-body');

const spinner = (
    `<div class="loadingio-spinner-double-ring-hsf1x3trzku d-flex justify-content-center">
        <div class="ldio-xopg5s16mug">
            <div></div>
            <div></div>
        </div>
    </div>`
);

const csrfParam = $('meta[name="csrf-param"]').attr("content");
const csrfToken = $('meta[name="csrf-token"]').attr("content");

const headers = {
    "content-type": "application/x-www-form-urlencoded",
    "is-ajax": "true"
};

class MyClass {
    constructor() {}

    /**
     * Загрузка данных
     * @param url
     * @returns {Promise<string>}
     */
    getResource = async ({url, body = null, method = 'GET', format = 'text'}) => {
        const res = await fetch(url, {
            method: method,
            body: body,
            headers: {
                "content-type": "application/x-www-form-urlencoded",
                "is-ajax": "true"
            }
        });
        if (!res.ok) {
            throw new Error(
                `Could not fetch ${url}, received ${res.status}\r\n` +
                `Message: ${res.statusText}`
            );
        }

        const result = await format === 'text' ? res.text() : res.json();
        return result;
    };

    btnLoading (btn, run = false) {
        const initialText = btn.data('initial-text');
        const loadingText = btn.data('loading-text');
        if(run) {
            btn.attr("disabled", true);
            btn.html(loadingText).addClass('disabled');
        } else {
            btn.attr("disabled", false);
            btn.html(initialText).removeClass('disabled');
        }
    }

    notify (title, text = '', addclass = 'bg-success border-success') {
        new PNotify({
            title,
            text,
            addclass
        });
    }

    modalAppend(data) {
        return MODAL_BODY
            .empty()
            .append(data);
    }
}