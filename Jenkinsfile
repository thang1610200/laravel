pipeline {
    agent any
    environment {
        PATH_PROJECT = '/var/www/laravel'
    }

    stages {
        stage('Check sourse'){
            steps {
                script {
                    sh ('sudo cp -r . $PATH_PROJECT')
                    echo 'Success'
                }
            }
        }

        stage('Test with laravel'){
            steps {
                script {
                    sh ('cd $PATH_PROJECT')
                    sh ('docker-compose start php')
                    //sh ('docker run ') // run image thanhf container
                    echo 'sd'
                }
            }
        }
    }
}