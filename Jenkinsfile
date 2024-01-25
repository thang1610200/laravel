pipeline {
    agent any
    environment {
        PATH_PROJECT = '/var/www/laravel'
        SONAR_PROJECT_KEY = 'thang1610200_laravel_AY0vjgwR8-iSJNTe88UN'
    }

    stages {
        stage('Check sourse'){
            steps {
                script {
                    //sh ('sudo chown -R jenkins:jenkins /var/lib/jenkins/workspace')
                    sh ('sudo cp -r . $PATH_PROJECT')
                    echo 'Success'
                }
            }
        }

        // stage('SonarQube Analysis') {
        //     steps {
        //         script {
        //             scannerHome = tool 'SonarQube Scanner';
        //         }
        //         withSonarQubeEnv('SonarQube server connection') {
        //             sh "${scannerHome}/bin/sonar-scanner"
        //         }
        //     }
        // }

        // stage('Test with laravel'){
        //     steps {
        //         script {
        //             sh ('cd $PATH_PROJECT')
        //             sh ('docker-compose up --build php')
        //             //sh ('docker run ') // run image thanhf container
        //             echo 'sd'
        //         }
        //     }
        // }


        stage('Build'){
            steps{
                script {
                    println GIT_BRANCH
                    sh ('cd $PATH_PROJECT')
                    sh ('sudo docker-compose up --build -d')
                }
            }
        }

        stage('Migrate And Seeder'){
            steps{
                script{
                    sh ("sudo docker exec laravel-php-1 bash -c 'php artisan migrate'")
                    sh ("sudo docker exec laravel-php-1 bash -c 'php artisan db:seed'")
                }
            }
        }   
    }
}