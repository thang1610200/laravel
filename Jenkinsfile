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
        stage(''){
            steps {
                script {
                    sh ('cd $PATH_PROJECT')
                    sh ('sudo docker-compose up --build -d')
                }
            }
        }
    }
}