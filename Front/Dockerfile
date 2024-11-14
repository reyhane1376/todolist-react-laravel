FROM docker.arvancloud.ir/node:16

# Set the working directory
WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN npm install

# Expose port 3000
EXPOSE 3000

# Start the React development server
CMD ["npm", "start"]
