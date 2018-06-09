export default {
    install:function(Vue, options){
        Vue.prototype.$string = {};
        Vue.prototype.$string.toLowerCase = function (str) {
            return str.replace(/\s+/g, '-').toLowerCase();
        };
        

    }
};


