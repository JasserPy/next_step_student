import sys

def chatbot(answers):
    # Decision logic
    if answers[0].lower() == "yes":
        if answers[1].lower() == "yes":
            return "We recommend Business Intelligence!"
        else:
            return "You might enjoy Software Development!"
    else:
        return "Consider exploring fields like Design or Marketing."

# Simulate chatbot with answers from PHP
answers = sys.argv[1:]  # Get answers as arguments from PHP
result = chatbot(answers)
print(result)
