/*
 * This file is part of gFortune.
 *
 * gFortune is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * gFortune is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with gFortune.  If not, see <http://www.gnu.org/licenses/agpl.html>.
 */
/**
 * @author Stanislav Sidelnikov <sidelnikov.stanislav@gmail.com>
 * @date 17.07.12
 */
//(function () {
    var forms = $("#ajax-form").children("div"),
        typeLis = $('#operationTypes').find('li'),
        table = $('#operations-table');
    $("a.change-type").on('click', function (event) {
        event.preventDefault();
        var $this = $(this),
            parentLi = $this.parent('li');
        if (parentLi.hasClass('active')) {
            return;
        }
        var form = $("#" + $this.data('form')).parents('div.form');
        forms.addClass("hide");
        form.removeClass("hide");
        typeLis.removeClass("active");
        parentLi.addClass("active");
    });

    $('window').on('click', '.del-item', onDelItemClick);

    function confirmOperation(message) {
        // TODO Make a normal confirm
        return confirm(message);
    }

    /**
     * Should be executed when the del-item link is clicked
     * @param event
     */
    var onDelItemClick = function (event) {
        var $this = $(this);
        event.preventDefault();
        //noinspection JSUnresolvedVariable
        if (confirmOperation(transTexts['confirmDelete'])) {
            var id = $this.data('id'),
                link = $this.attr('href'),
                tr = $this.closest('tr');
            $.ajax({
                type:'post',
                url:link,
                beforeSend:function () {
                    tr.addClass('deleted-row', 300);
                },
                success:function () {
                    tr.fadeOut(300, function () {
                        tr.remove();
                    });
                }
            });
        }
    };

    $('.formSubmit').on('click', function (event) {
        event.preventDefault();
        var $this = $(this),
            link = $this.attr('href'),
            form = $this.parents('form');
        $.ajax({
            'success':opSubmitSuccess,
            'context':form,
            'type':'POST',
            'url':link,
            'cache':false,
            'data':form.serialize()
        });
    });

//    $('#resetFormBtn').on('click', function (event) {
//        event.preventDefault();
//        var form = $(this).parents('form');
//        clearForm(form);
//    });

    /**
     * Process the successful completion of the AJAX request to the save controller.
     * The controller should return the table partial view, so it updates the table
     * @param data The data returned by the ajax request - table formatting
     */
    function opSubmitSuccess(data, form) {
        if(data == null || data === "")
            return;
        table.html(data);
        table.find('tr.recent').removeClass('recent', 1500);
        clearForm(form);
    }

    /**
     * Resets the form's fields to its default state
     * @param form The form to be reset
     */
    function clearForm(form) {
        var selector = '#' + form.attr('id');
        form.children().removeClass('success')
        resetForm(selector);
    }

    function resetForm(selector) {
        $(':text, :password, :file, textarea', selector).val('');
        $(':input, select option', selector)
            .removeAttr('checked')
            .removeAttr('selected');
        $('select', selector).each(function () {
            $(this).find('option:first').attr('selected', true);
        })
    }

    $('#period-switch button').on(
        'click',
        function(e) {
            e.preventDefault();
            var link = '/operations/filter/' + $(this).data('index');
            $.ajax({
                'success': function(data) {
                    table.html(data);
                },
                'url':link
            });
        }
    );
//})();