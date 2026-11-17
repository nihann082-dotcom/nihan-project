<?php
$name = "Eman";
$year = date("Y");

require_once "connect.php";

$status = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $visitorName = trim($_POST["visitor_name"] ?? "");
    $visitorEmail = trim($_POST["visitor_email"] ?? "");
    $visitorMessage = trim($_POST["visitor_message"] ?? "");

    if (
        $visitorName !== "" &&
        filter_var($visitorEmail, FILTER_VALIDATE_EMAIL) &&
        $visitorMessage !== ""
    ) {

        $stmt = $conn->prepare(
            "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "sss",
                $visitorName,
                $visitorEmail,
                $visitorMessage
            );

            if ($stmt->execute()) {
                $status = "Message sent successfully! 💗";
            } else {
                $status = "Unable to send your message. Please try again.";
            }

            $stmt->close();

        } else {
            $status = "Something went wrong. Please try again.";
        }

    } else {
        $status = "Please enter a valid name, email, and message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Eman's Portfolio</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navigation -->
    <nav>
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
    </nav>

    <!-- Home Section -->
    <h1 id="home">Welcome to My Portfolio!</h1>

    <img src="image.jpg" alt="My cute cat" class="cat-photo">

    <h2>Hi, I'm <?php echo htmlspecialchars($name); ?> 🌸</h2>

    <p>I'm a Grade 12 student.</p>

    <p>Student | Web Developer | Designer</p>

    <!-- About Section -->
    <section>
        <h1 id="about">About Me</h1>

        <p>
            Hello! My name is Eman.
            I am a Grade 12 student who loves technology,
            web development, and creative design.
            I enjoy learning new things and creating websites.
        </p>
    </section>

    <!-- Skills Section -->
    <section>
        <h1 id="skills">My Skills</h1>

        <h3>HTML</h3>
        <p>Learning to create web pages.</p>

        <h3>CSS</h3>
        <p>Learning to design beautiful websites.</p>

        <h3>PHP</h3>
        <p>Learning server-side programming.</p>

        <h3>MySQL</h3>
        <p>Learning database management.</p>

        <h3>JavaScript</h3>
        <p>Learning to make websites interactive.</p>
    </section>

    <!-- Projects Section -->
    <section>
        <h1 id="projects">My Projects</h1>

        <h3>Personal Portfolio Website</h3>
        <p>A website that introduces me and showcases my skills.</p>

        <h3>Registration System</h3>
        <p>A PHP and MySQL project that stores user information.</p>

        <h3>Future Projects</h3>
        <p>I am excited to create more websites and applications.</p>
    </section>

    <!-- Contact Section -->
    <section>
        <h1 id="contact">Contact Me 💌</h1>

        <p>I would love to hear from you!</p>

        <form method="POST" action="">

            <input
                type="text"
                name="visitor_name"
                placeholder="Your Name"
                required
            >

            <br><br>

            <input
                type="email"
                name="visitor_email"
                placeholder="Your Email"
                required
            >

            <br><br>

            <textarea
                name="visitor_message"
                placeholder="Your Message"
                required
            ></textarea>

            <br><br>

            <button type="submit">Send Message 💗</button>

        </form>

        <p role="status">
            <?php echo htmlspecialchars($status); ?>
        </p>
    </section>

    <!-- Footer -->
    <footer>
        <p>© <?php echo $year; ?> Eman | My Personal Portfolio 🌸</p>
        <p>Made with love 🐱</p>
    </footer>

</body>
</html>