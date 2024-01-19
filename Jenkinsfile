pipeline {
    agent any

    stages {
        stage('Prepare'){
            steps {
                script {
                    sh ('cp -r * var/www/laravel')
                    sh ('cd var/www/laravel')
                    echo 'Success'
                }
            }
        }
        stage('Build'){
            steps {
                echo 'Test'
            }
        }
    }
}