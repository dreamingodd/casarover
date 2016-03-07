define(function(){
    /**
     * Convert methods for textarea(HTML).
     * The methods' functionalities are obviously self-explanatory.
     */
    var LFtoBR = function (str) {
        if (str) {
            return str.split('\n').join('<BR/>');
        } else return str;
    };
    var BRtoLF = function (str) {
        if (str) {
            str = str.split('<BR/>').join('\n');
            str = str.split('&lt;BR/&gt;').join('\n');
            return str;
        } else return str;
    };
    /**
     * e.g. www.casarover.com/casarover/
     */
    var getBaseUrl = function () {
        var backstage_url = $('#backstage_url').val();
        if (backstage_url) {
            var end = backstage_url.lastIndexOf('casarover/') + 10;
            return backstage_url.substring(0, end);
        } else {
            alert("Backstage url is missing!");
        }
    };
    /**
     * e.g. www.casarover.com/
     */
    var getRootUrl = function () {
        var backstage_url = $('#backstage_url').val();
        if (backstage_url) {
            return backstage_url.replace('casarover/website/backstage/', '');
        } else {
            alert("Backstage url is missing!");
        }
    };
    return {
        LFtoBR : LFtoBR,
        BRtoLF : BRtoLF,
        getBaseUrl : getBaseUrl,
        getRootUrl : getRootUrl
    };
});

