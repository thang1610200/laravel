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

        // stage('Create .env'){
        //     steps {
        //         script {
        //             sh ('cd $PATH_PROJECT')
        //             sh ('docker-compose --env-file .env up')
        //         }
        //     }
        // }

        stage('Test with laravel'){
            steps {
                script {
                    sh ('cd $PATH_PROJECT')
                    sh ('docker-compose up -d')
                    echo 'sd'
                }
            }
        }
    }
}