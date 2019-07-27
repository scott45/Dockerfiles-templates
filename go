FROM golang:latest 

LABEL AUTHOR="Scott Businge <businge.scott@andela.com>"
LABEL app="app-name"

RUN mkdir /app 
ADD . /app/ 
WORKDIR /app

# installation
RUN go install github.com/golang/example/file 

# execution
ENTRYPOINT /go/bin/file

EXPOSE 8080
