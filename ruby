FROM ruby:2.3.1-alpine

LABEL AUTHOR="Scott Businge <businge.scott@andela.com>"
LABEL app="app-name"

ADD Gemfile /app/
ADD Gemfile.lock /app/

RUN apk --update add --virtual build-dependencies ruby-dev build-base && \
    gem install bundler --no-ri --no-rdoc && \
    cd /app ; bundle install --without development test && \
    apk del build-dependencies

WORKDIR /app

ADD . /app

ENV RACK_ENV production
EXPOSE 9292
