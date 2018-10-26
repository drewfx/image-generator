$ = jQuery.noConflict();

$(document).foundation();

class Format {
    static capitalize(string) {
        return string[0].toUpperCase() + string.slice(1).toLowerCase();
    }
}

class Image {

    /**
     * Image constructor
     */
    constructor() {
        this.preview = $('.preview img');
        this.default = '/img/placeholder.png';
    }

    /**
     * Set the options image to the preview
     * @param option
     */
    change(option) {
        let src = '/img/' + option + '.jpg';

        (option !== '' && Image.exists(src) === true)
            ? this.preview.attr('src', src)
            : this.preview.attr('src', this.default);
    }

    /**
     * Checks to see if an image exists
     * @param url
     * @returns {boolean}
     */
    static exists(url) {
        let http = new XMLHttpRequest();

        http.open('HEAD', url, false);
        http.send();

        return (http.status !== 404);
    }
}

class Input {
    /**
     *
     * @param name
     * @returns {string}
     */
    static create(name, type) {
        return "<label for='" + name + "'>" + Format.capitalize(name) +
            ((name !== 'name') ? "<span class='details'> (in inches)</span>" : "") +
            "</label><input type='" + type + "' class='inputs' name='" + name + "' step='0.5'>"
    }
}

class Button {
    static group() {
        return "<div class=\"button-group\">"
            + Button.submit()
            + Button.reset()
            + "</div>";
    }

    static submit() {
        return "<button type='submit' class='button'>Submit</button>"
    }

    static reset() {
        return "<button type='reset' class='button warning'>Reset</button>"
    }
}

class Form {
    constructor() {
        this.html = '';
        this.target = $('div.measurements');
        this.default = 'Please select an article.';
        this.forms = {
            longsleeve: {
                inputs: [
                    'length',
                    'width',
                    'sleeve-length'
                ]
            },
            tshirt: {
                inputs: [
                    'length',
                    'width'
                ]
            },
            shoe: {
                inputs: [
                    'length',
                    'width'
                ]
            },
            pants: {
                inputs: [
                    'waist',    // top
                    'rise',     // top of pants to crotch
                    'inseam',   // Inside of leg
                    'leg-width' // crotch to outside
                ]
            }
        };
    }

    /**
     * Create the form.
     * @param option
     */
    create(option) {
        // Empty html
        this.html = "";
        this.target.empty();

        this.html += "<form action='/create-article' method='post'>";
        this.html += "<input type='hidden' name='type' value='" + option + "'>";
        this.body(option);
        this.html += "</form>";

        this.target.append(this.html);
    }

    /**
     * Create the body of the form.
     * @param option
     */
    body(option) {
        if (option in this.forms) {
            let article = this.forms[option];

            this.html += Input.create('name', 'text');

            for (let input of article.inputs) {
                this.html += Input.create(input, 'number');
            }

            this.html += Button.group();
        } else {
            this.html = this.default;
        }
    }

    submit() {

    }
}

$(function() {
    let image = new Image();
    let form = new Form();

    $("form").submit(function(e) {
        e.preventDefault();

    });

    $("#clothing").change(function() {
        image.change($(this).val());
        form.create($(this).val());
    });
});