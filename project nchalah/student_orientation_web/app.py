from flask import Flask, render_template, request, redirect, url_for, jsonify
from flask_cors import CORS  # For handling CORS if needed

app = Flask(__name__, static_folder='static')
CORS(app)  # Enable CORS for all routes

# Reduced questions to 10
questions = [
    "Would you like to study Informatique?",
    "Are you interested in Business?",
    "Do you enjoy creative problem-solving?",
    "Do you like working with data?",
    "Are you passionate about healthcare?",
    "Do you enjoy designing and creating?",
    "Are you interested in robotics and automation?",
    "Are you interested in finance and investments?",
    "Do you enjoy studying human behavior and psychology?",
    "Would you like to work with artificial intelligence?"
]

# Adjusted recommendations for 10 questions
recommendations = [
    ("Business Intelligence", [True, True, False, True, False, False, False, True, False, False]),
    ("Software Engineering", [True, False, True, True, False, False, True, False, False, True]),
    ("Marketing Management", [False, True, False, False, False, False, False, True, False, False]),
    ("Healthcare Administration", [False, False, False, False, True, False, False, False, False, False]),
    ("Graphic Design", [False, False, False, False, False, True, False, False, False, False]),
    ("Robotics Engineering", [True, False, True, True, False, False, True, False, False, False]),
    ("Finance and Investments", [False, True, False, False, False, False, False, True, False, False]),
    ("Psychology", [False, False, False, False, False, False, False, False, True, False]),
    ("Artificial Intelligence", [True, False, True, True, False, False, False, False, False, True]),
    ("Civil Engineering", [False, False, False, False, False, False, True, False, False, False])
]

answers = []

@app.route("/", methods=["GET", "POST"])
def home():
    if request.method == "POST":
        if "start" in request.form:
            return redirect(url_for("question"))
        elif "exit" in request.form:
            return render_template("goodbye.html")

    return render_template("intro.html")

@app.route("/question", methods=["GET", "POST"])
def question():
    if request.method == "POST":
        answer = request.form.get("answer")
        answers.append(answer == "yes")
        if len(answers) < len(questions):
            return redirect(url_for("question"))
        return redirect(url_for("result"))

    question = questions[len(answers)]
    return render_template("question.html", question=question)

@app.route("/result")
def result():
    best_recommendation = None
    best_score = -1

    # Compare the student's answers with each recommendation pattern
    for recommendation, pattern in recommendations:
        # Calculate the similarity score (number of matching answers)
        score = sum(1 for a, p in zip(answers, pattern) if a == p)

        # Update the best recommendation if this one has a higher score
        if score > best_score:
            best_recommendation = recommendation
            best_score = score

    # If no good match is found, fall back to a general recommendation
    if best_recommendation is None:
        best_recommendation = "General Studies"

    return render_template("result.html", recommendation=best_recommendation)

# New API endpoint to start the quiz
@app.route("/start-quiz", methods=["POST"])
def start_quiz():
    global answers
    answers = []  # Reset answers when starting the quiz
    return jsonify({"status": "success", "message": "Quiz started!"})

if __name__ == "__main__":
    app.run(debug=True)