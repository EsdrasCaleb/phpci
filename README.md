This is a simple project to make a php script to make a Continuos Integration with your project
you create you env file. This code was made with AI assist.


Create a Webhook in GitHub

-Go to your GitHub repository.
-Click on Settings.
-In the left sidebar, click on Webhooks.
-Click Add webhook.
-Set the Payload URL to the URL of the PHP script you will create (e.g., http://yourdomain.com/git-pull.php).
-Set the Content type to application/json.
-Choose the event types you want to trigger the webhook. For a simple setup, you can select "Just the push event."
-Click Add webhook.


If you do not have your project with the ssh pull automatic configures you need to fill the token variable in env and configure a token in your github

Steps to Create a GitHub Personal Access Token (PAT)
----------------------------------------------------

### 1\. **Log in to GitHub**

-   Go to [GitHub.com](https://github.com/) and log in to your account.

### 2\. **Navigate to Settings**

-   In the upper-right corner of any page, click your profile photo.
-   Select **Settings** from the dropdown menu.

### 3\. **Access Developer Settings**

-   On the left sidebar, scroll down and click on **Developer settings**.

### 4\. **Personal Access Tokens**

-   In the left sidebar, click on **Personal access tokens**.
-   Click **Tokens (classic)** if you are creating a classic token.

### 5\. **Generate New Token**

-   Click on **Generate new token**.
-   If prompted, confirm your GitHub password.

### 6\. **Configure Token Settings**

-   **Token Description:** Enter a descriptive name for your token (e.g., `MyProjectToken`).
-   **Expiration:** Choose an expiration date for the token (e.g., 30 days, 60 days, or custom).
-   **Select Scopes:**
    -   Choose the scopes or permissions you'd like to grant this token. For example:
        -   `repo` -- Full control of private repositories.
        -   `workflow` -- Update GitHub Actions workflows.
        -   `admin:org` -- Read and write in organizations.
        -   `gist` -- Create gists.
        -   Other scopes depending on your needs.

### 7\. **Generate Token**

-   After selecting the desired scopes, scroll down and click **Generate token**.

### 8\. **Copy and Save the Token**

-   **Important:** Once the token is generated, copy it immediately. You won't be able to see it again!
-   Save the token in a secure place (e.g., a password manager).

### 9\. **Use the Token**

-   You can now use this token for accessing GitHub APIs, cloning repositories, or other operations that require authentication.