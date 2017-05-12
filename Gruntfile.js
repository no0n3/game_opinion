module.exports = function (grunt) {

    grunt.initConfig({
        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            target: {
                files: {
                    'web/css/app.min.css': [
                        'web/css/site.css',
                        'vendor/bower/bootstrap/dist/css/bootstrap.css',
                    ],
                }
            }
        },
        concat: {
            basic: {
                files: {
                    'web/js/all.js': [
                        'vendor/bower/jquery/dist/jquery.js',
                        'vendor/bower/bootstrap/dist/js/bootstrap.js',

                        'vendor/yiisoft/yii2/assets/yii.js',
                        'vendor/yiisoft/yii2/assets/yii.activeForm.js',
                        'vendor/yiisoft/yii2/assets/yii.validation.js',
                        'vendor/yiisoft/yii2/assets/yii.captcha.js',
                        'vendor/yiisoft/yii2/assets/yii.gridView.js',

                        'web/js/app.js',
                    ],
                },
            },
        },
        uglify: {
            options: {},
            dist: {
                files: {
                    'web/js/all.min.js': ['web/js/all.js'],
                }
            }
        },
        watch: {
            options: {},
            grunt: {
                files: ['Gruntfile.js'],
                tasks: ['cssmin', 'concat', 'uglify']
            },
            app_js: {
                files: [
                    'web/js/**/*.js', 
                    '!web/js/**/*.min.js'
                ],
                tasks: ['concat', 'uglify']
            },
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('default', ['cssmin', 'concat', 'uglify', 'watch']);

    grunt.registerTask('css', ['cssmin']);
    grunt.registerTask('js', ['concat', 'uglify']);

};
