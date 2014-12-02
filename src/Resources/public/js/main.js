$(document).ready(function(){

    /**
     * Json Syntax Highlight
     *
     * @param json
     * @returns {XML|string}
     */
    function syntaxHighlight(json) {
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }

    /**
     * Panels slide toggle
     */
    $('.panel-heading').click(function(){
        $(this).parent().find('.panel-body').slideToggle();
    });

    /**
     * Simple search
     */
    $('#search-input').on('input',function(){
        var val = $(this).val();
        if (val!=='') {
            $('.test-url-doc').each(function(){
                if ($(this).attr('data-url').indexOf(val) >= 0) {
                    $(this).show();
                } else {
                    $(this).hide();
                }

            });
        } else {
            $('.test-url-doc').show();
        }

    });

    $('pre').scroll(function(){
        $(this).addClass('scrollable');
    });

    /**
     * Turn on Syntax highlight
     */
    $('pre.json').each(function(index, element){
        var text = $(element).text();
        if (!text) {
            return;
        }
        try {
            var $jsonObject = $.parseJSON(text);
            $(element).html(syntaxHighlight(JSON.stringify($jsonObject, null, 4)));
        } catch (error) {
            console.log(error);
        }
    });

});