<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website'];
$comment = $_POST['comment'];
$gender = $_POST['gender'];

$servername = "db";
$username = "root";
$password = "root";
$dbname = "FCT";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (name, email, website, comment, gender)
        VALUES ('$name', '$email', '$website', '$comment', '$gender')";
?>

<!DOCTYPE html>
<html>
<head>
<title>Form Submission Result</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    
    .result-container {
        width: 100%;
        max-width: 800px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .result-header {
        background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .result-header h2 {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }
    
    .result-header p {
        font-size: 16px;
        opacity: 0.9;
    }
    
    .result-content {
        padding: 40px;
    }
    
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 20px;
        border-radius: 8px;
        border-left: 5px solid #28a745;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
    }
    
    .success-message h3 {
        margin-left: 15px;
        font-size: 22px;
    }
    
    .success-icon {
        font-size: 28px;
        font-weight: bold;
    }
    
    .info-section {
        margin-bottom: 35px;
    }
    
    .info-section h3 {
        color: #333;
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .user-info {
        list-style-type: none;
    }
    
    .user-info li {
        padding: 18px 20px;
        margin-bottom: 12px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #4b6cb7;
        display: flex;
    }
    
    .info-label {
        font-weight: 600;
        color: #333;
        min-width: 120px;
    }
    
    .info-value {
        color: #555;
        flex: 1;
    }
    
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 20px;
        border-radius: 8px;
        border-left: 5px solid #dc3545;
        margin-bottom: 30px;
    }
    
    .error-message h3 {
        font-size: 22px;
        margin-bottom: 10px;
    }
    
    .actions {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 20px;
    }
    
    .btn {
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .btn-primary {
        background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
        color: white;
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(75, 108, 183, 0.2);
    }
    
    .btn-secondary {
        background-color: #f8f9fa;
        color: #333;
        border: 2px solid #ddd;
    }
    
    .btn-secondary:hover {
        background-color: #e9ecef;
        border-color: #ccc;
    }
    
    .footer {
        text-align: center;
        padding: 20px;
        color: #666;
        font-size: 14px;
        border-top: 1px solid #eee;
        background-color: #f8f9fa;
    }
    
    @media (max-width: 600px) {
        .result-container {
            border-radius: 10px;
        }
        
        .result-content {
            padding: 25px;
        }
        
        .user-info li {
            flex-direction: column;
        }
        
        .info-label {
            margin-bottom: 5px;
        }
        
        .actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>
</head>
<body>
    <div class="result-container">
        <div class="result-header">
            <h2>Form Submission Result</h2>
            <p>Your information has been processed</p>
        </div>
        
        <div class="result-content">
            <?php if (mysqli_query($conn, $sql)): ?>
                <div class="success-message">
                    <div class="success-icon">✓</div>
                    <h3>New record created successfully!</h3>
                </div>
                
                <div class="info-section">
                    <h3>Submitted Information:</h3>
                    <ul class="user-info">
                        <li>
                            <span class="info-label">Name:</span>
                            <span class="info-value"><?php echo htmlspecialchars($name); ?></span>
                        </li>
                        <li>
                            <span class="info-label">Email:</span>
                            <span class="info-value"><?php echo htmlspecialchars($email); ?></span>
                        </li>
                        <li>
                            <span class="info-label">Website:</span>
                            <span class="info-value"><?php echo htmlspecialchars($website) ? htmlspecialchars($website) : '<em>Not provided</em>'; ?></span>
                        </li>
                        <li>
                            <span class="info-label">Comment:</span>
                            <span class="info-value"><?php echo htmlspecialchars($comment) ? htmlspecialchars($comment) : '<em>No comment provided</em>'; ?></span>
                        </li>
                        <li>
                            <span class="info-label">Gender:</span>
                            <span class="info-value"><?php echo htmlspecialchars($gender); ?></span>
                        </li>
                    </ul>
                </div>
                
                <div class="actions">
                    <a href="signup.html" class="btn btn-primary">Submit Another Form</a>
                    <a href="#" class="btn btn-secondary">Return to Homepage</a>
                </div>
            <?php else: ?>
                <div class="error-message">
                    <h3>Error Processing Your Request</h3>
                    <p>There was an issue with your submission. Please try again.</p>
                    <p><strong>Error Details:</strong> <?php echo mysqli_error($conn); ?></p>
                </div>
                
                <div class="actions">
                    <a href="signup.html" class="btn btn-primary">Go Back to Form</a>
                </div>
            <?php endif; ?>
            
            <?php mysqli_close($conn); ?>
        </div>
        
        <div class="footer">
            <p>Thank you for submitting your information. We value your privacy.</p>
        </div>
    </div>
</body>
</html>
