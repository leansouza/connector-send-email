global['context'] = {};
global['context']['config'] = [{
    "name": "email rich text",
    "items": [{
        "label": "Rich Text",
        "config": {
            "icon": "fas fa-pencil-ruler",
            "label": null,
            "content": "<p style=\"text-align: center;\"><em><strong>Rich text editor</strong></em></p>",
            "interactive": true
        },
        "component": "FormHtmlEditor",
        "inspector": [{
            "type": "FormTextArea",
            "field": "content",
            "config": {
                "rows": 5,
                "label": "Rich Text Content",
                "value": null,
                "helper": "The HTML text to display"
            }
        }, {
            "type": "ColorSelect",
            "field": "bgcolor",
            "config": {
                "label": "Element Background color",
                "helper": "Set the element's background color",
                "options": [{
                    "value": "alert alert-primary",
                    "content": "primary"
                }, {
                    "value": "alert alert-secondary",
                    "content": "secondary"
                }, {
                    "value": "alert alert-success",
                    "content": "success"
                }, {
                    "value": "alert alert-danger",
                    "content": "danger"
                }, {
                    "value": "alert alert-warning",
                    "content": "warning"
                }, {
                    "value": "alert alert-info",
                    "content": "info"
                }, {
                    "value": "alert alert-light",
                    "content": "light"
                }, {
                    "value": "alert alert-dark",
                    "content": "dark"
                }]
            }
        }],
        "editor-component": "FormHtmlEditor"
    }]
}];

global['context']['data'] = {
    "users": [
        {"name": "John Shuster", "position": "skip"},
        {"name": "Tyler George", "position": "vice"},
        {"name": "Mark Hamilton", "position": "second"},
        {"name": "John Landstiner", "position": "lead"},
    ]
};

require('../dist/main.js');