let config = {
    "map": {
        "*": {
            "fadeInElement" : "Tsintsadze_JsReq/js/fade-in-element",
            "Magento_Review/js/submit-review" : "Tsintsadze_JsReq/js/submit-review"
        }
    },
    "paths" : {
        "vue" : [
            "https://cdn.jsdelivr.net/npm/vue/dist/vue",
            "Tsintsadze_JsReq/js/vue"
        ]
    },
    "shim" : {
        "Tsintsadze_JsReq/js/jquery-log" : ["jquery"]
    },
    "deps" : ["Tsintsadze_JsReq/js/every-page"],
    "config" : {
        "mixins" : {
            "Magento_Ui/js/view/messages" : {
                "Tsintsadze_JsReq/js/messages-mixin" : true
            }
        }
    }
}
