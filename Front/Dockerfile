# Use the Node.js image as the base image
FROM docker.arvancloud.ir/node:16

# Set the working directory and ensure it is writable by the user
WORKDIR /app

# Use an existing non-root user (node is built-in with the Node image)
USER node

# Copy application files
COPY --chown=node:node . .

# Install dependencies
RUN npm install

# Expose the application port
EXPOSE 5173

# Start the React development server
CMD ["npm", "start"]
