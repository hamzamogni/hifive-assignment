FROM node:latest as build-stage
WORKDIR /app

# COPY ./webapp/package*.json ./
# RUN npm install

COPY ./webapp/ .
# RUN npm install
RUN npm run build

# FROM nginx as production-stage
# RUN mkdir /app
# COPY --from=build-stage /app/dist /app
# COPY ../nginx/nginx.conf /etc/nginx/nginx.conf