pipeline {
    agent any

    environment {
		DOCKERHUB_CREDENTIALS=credentials('dockerhub-accstoken')
        //APP_BUILD_NUM = ''
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
    }
    // parameters {
    //     string defaultValue: BUILD_NUMBER, name: 'APP_BUILD_NUM'
    // }
    post {
		always {
		    sh "docker logout"
	    }
//         success {
// 		    script {
//                 build job: "k8sdeploy", parameters: [string(name: 'APP_BUILD_NUM', value: "${params.APP_BUILD_NUM}")]
//             }
// 	    }
// 	}  
// }