pipeline {
    agent any

    environment {
		DOCKERHUB_CREDENTIALS=credentials('dockerhub-accstoken')
	}
    stages {
        stage('Build DockerImage') {
            steps {
                sh "docker build -t Giver Your Repo Name/symfony:$BUILD_NUMBER ."
            }
        }
        stage('Scan DockerImage') {
            steps {
                sh "docker scan Giver Your Repo Name/symfony:$BUILD_NUMBER"
            }
        }
        stage('Docker Login') {

			steps {
				sh "echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin"
			}
		}
        stage('Push DockerImage') {
            steps {
                sh "docker push Giver Your Repo Name/symfony:$BUILD_NUMBER"
            }
        }
    }
    post {
		always {
		    sh "docker logout"
	    }
	}  
}