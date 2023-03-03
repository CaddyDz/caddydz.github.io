# syntax=docker/dockerfile:1.2

FROM node:12-alpine

WORKDIR /app

COPY ../../package* .
RUN npm ci

CMD [ "npm", "run", "watch" ]
