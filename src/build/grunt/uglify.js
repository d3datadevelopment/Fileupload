module.exports = {

    options: {
        preserveComments: 'some'
    },
    
    module: {
        options: {
            sourceMap: false,
        },
        files: [
            {
                expand: true,
                src:    "*.js",
                cwd:    "sources/js/",
                dest:   "../out/src/js/",
                ext:    ".min.js",
                extDot: "last"
            }
        ]
    },
};
