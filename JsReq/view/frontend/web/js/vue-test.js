define(["vue", "jquery", "Tsintsadze_JsReq/js/jquery-log"], function (Vue,$) {
    "use strict"

    $.log("Testing output to the console")

    return function (config, element) {
        return new Vue ({
            el: "#" + element.id,
            data: {
                message: config.message
            }
        })
    }
})
