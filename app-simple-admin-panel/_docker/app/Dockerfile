# Use an official Node.js runtime as the base image
FROM node:latest

# Copy package.json and package-lock.json to the container
COPY ./app-simple-admin-panel/package*.json ./

# Install app dependencies
RUN npm install

# Copy the rest of the application files to the container
COPY . .

#EXPOSE 3000

# Set the working directory in the container
WORKDIR /usr/src/index

# Command to start the application
CMD ["node", "index.js"]

# express это тот же node (поверх), только с маршрутизацией
# vue (ssr) + express тоже будет обсулживаться как серверное приложение