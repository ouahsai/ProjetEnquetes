(function($) {
    
    var $controls = $('.controls'),
        $entry = $controls.find('.entry'),
        $qcm = $controls.find('.qcm'),
        initText = "Type de réponse à cette question",
        caret = "&nbsp;<span class='caret'></span>",
        currentButtonHtml = $controls.find('.btn-group button')
                            .html(initText + caret).html(),
    init = function() {
        $qcm.hide();
        events();
    },
    events = function() {
        $controls.on('click', '.btn-add', function(e) {
            
            var newEntry = cloneElement(e, $(this), '');
            newEntry.find('.entry-qcm:not(:last)').remove();
            
            $controls.trigger("setIndexes")
                     .trigger("setSessionStorage");

            newEntry.find('.btn-group > button').html(currentButtonHtml)
                    .end().find('.qcm').hide();

        }).on('click', '.btn-remove', function(e) {
            e.preventDefault();

            $(this).parents('.entry:first').remove();
            $controls.trigger("setIndexes")
                     .trigger("setSessionStorage");

        }).on('click', '.btn-group > ul a', function(e) {
            e.preventDefault();
               
            var currentText = $(this).text(),
                $currentQcm = $(this).parents(".entry").find(".qcm"),
                $ulParent = $(this).parent().parent(),
                $hidden = $ulParent.find(".hidden");

            $hidden.val(currentText);
            $ulParent.prev().html(currentText + caret);

            if ($(this).parent().index() === 2) { //case QCM
                $currentQcm.show();
                $controls.trigger("setSessionStorage");
            } else {
                $currentQcm.hide();
                $controls.trigger("setSessionStorage");
            }
 
        }).on('click', '.btn-add-qcm', function(e) {
            cloneElement(e, $(this), '-qcm');
        }).on('click', '.btn-remove-qcm', function(e){
            e.preventDefault();
            $(this).parents('.entry-qcm:first').remove();
        
        }).on("setIndexes", function() {
            $(this).find('.qcm').each(function(index){
                $(this).find("input[name]")
                       .attr("name", "qcm"+index+"[]");
            });                        

        }).on("setSessionStorage", function() {
            sessionStorage.setItem("Form", $(this).html());
        });
        
        var cloneElement = function(e, $this, suffix) {
            e.preventDefault();

            var currentEntry = $this.parents('.entry'+suffix+':first'),
                newEntry = $(currentEntry.clone(true)).insertAfter(currentEntry);

            newEntry.find('input').val('');
            currentEntry.parent().find('.entry'+suffix+':not(:last) .btn-add'+suffix)
                .removeClass('btn-add'+suffix).addClass('btn-remove'+suffix)
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');

            return newEntry;    
        };
    };
    if ($('.controls').length) { init(); }
    
})(jQuery);


