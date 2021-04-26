$(function () {
    /**
     * Провера состояния телеграмм бота
     */
    $(document).on('click', '.btn-bot-check', async (e) => {
        e.preventDefault();
        const { currentTarget } = e;
        const {dataset: {editurl, action}} = e.target;
        const data   = `${csrfParam}=${csrfToken}&status=${action}`;
        const method = 'POST';

        if( action === 'del' &&
            !confirm("Вы уверены, что хотите отключить бота?")
        ) return false;

        await queryOnServer({ editurl, currentTarget, data, method });
    });

});