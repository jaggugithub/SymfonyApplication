pipeline {
    agent any

    environment {
		DOCKERHUB_CREDENTIALS=credentials('dockerhub-accstoken')
	}
    stages {
        stage('Build Docker Image') {
            steps {
                sh "docker build -t jaggu199/symfony:$BUILD_NUMBER ."
            }
        }
        stage('Scan Docker Image') {
            steps {
                sh "docker scan jaggu199/symfony:$BUILD_NUMBER"
            }
        }
        stage('Docker Login') {

			steps {
				sh "echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin"
			}
		}
        stage('Push Docker Image') {
            steps {
                sh "docker push jaggu199/symfony:$BUILD_NUMBER"
            }
        }
        post {
		    always {
			    sh "docker logout"
		    }
	    }
    }    
}