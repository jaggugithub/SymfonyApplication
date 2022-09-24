pipeline {
    agent any

    environment {
		DOCKERHUB_CREDENTIALS=credentials('dockerhub-accstoken')
	}
    stages {
        stage('Build DockerImage') {
            steps {
                sh "docker build -t jaggu199/symfony:$BUILD_NUMBER ."
            }
        }
        stage('Scan DockerImage') {
            steps {
                sh "docker scan jaggu199/symfony:$BUILD_NUMBER"
            }
        }
        stage('Docker Login') {

			steps {
				sh "echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin"
			}
		}
        stage('Push DockerImage') {
            steps {
                sh "docker push jaggu199/symfony:$BUILD_NUMBER"
            }
        }
        stage('Store Build Number') {
            steps {
                sh "echo $BUILD_NUMBER >> buildnum.txt"
            }
        }
    }
    post {
		always {
		    sh "docker logout"
	    }
 	}  
}