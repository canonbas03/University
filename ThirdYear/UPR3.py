"""
# Exercise 1
text1 = "Hello, \nwhen do we make a test"
print(text1)


# Exercise 2
text2 = "A\tB\tC\t"
print(text2)


# Exercise 3
text3= "Път до папка: C:\\Users\\Ivan"  
print(text3)


# Exercise 4 & 5
text4 = 'Това е пример за \"единична\' кавичка.'
print(text4)


name = "Иван"
text1 = "Здравей, %s!" % name
print(text1)


age = 25
text2 = "На %d години съм." % age
print(text2)


price = 12.5
text3 = "Цената е %f лева." % price
print(text3)


# Пример 1: Използване на %s
name = "Иван"
middle = "Проба"
text1 = "Здравей, %s %s!" % (name, middle)
print(text1)


# Пример 2: Използване на %d за цели числа
age = 25
text2 = "На %d години съм." % age
print(text2)


# Пример 3: Използване на %f за числа с плаваща запетая
price = 12.5
text3 = "Цената е %f лева." % price
print(text3)


# Пример 4: Фиксирана прецизност с %.2f
pi = 3.14159
text4 = "Стойността на π е приблизително %.2f." % pi
print(text4)


# Пример 5: Комбинация от няколко спецификатора
name = "Петър"
age = 30
salary = 1500.4567
text5 = "Казвам се %s, на %d години съм и получавам %.2f лева." %(name, age, salary)
print(text5)


#################______-----______-----______-----________-----_______#################




# Individual exercises
# Exercise 1
word1 = "One"
word2 = "Two"
word3 = "Three"


finalWord = "%s-%s-%s" %(word1,word2,word3)
print(finalWord)


finalWord2 = "-".join([word1,word2,word3])
print(finalWord2)


# Exercise 2
text = "Hello, Python World!"


print(text.upper())
print(text.lower())
print((text.title()).swapcase())


# Exercise 3
phrase = " Python is fun "
print(phrase.strip())
print(phrase.replace(" ", ""))


# Exercise 4
phrase2 = "Big Data Analytics"
index = phrase2.find("Data")


print("You found the word \'Data\' in index: %s" %(index))


# Exercise 5
tech = "Artificial Intelligence"
length = len(tech)
tech.replace("Artificial", "Machine")
print(length)
print(tech)


# Exercise 6
sentence = "Learning Python is very interesting!"
print(sentence[0:8])


# Exercise 7
msg = "Keep Going Forward"
print(msg[-7::])


# Exercise 8
text6 = "Welcome to Python"
check1 = text6.startswith("Welcome")
check2 = text6.endswith("Python")


print(check1)
print(check2)


# Exercise 9
text = "Python3"


print(text.isalpha())


# Exercise 10
word = input("Write your word: ")


print("%s%s" %(word[0:3], word[-3::]))

# Exercise 11
text = "Object Oriented Programming"
splited = text.split()
final = ""


for word in splited:
   
    final += word[0]
   
print(final)


# Exercise 12
text = "HelLo World, hello Python!"

counter = (text.lower()).count("l")
print (counter)

# Exercise 13
quote = " Stay hungry, stay foolish. "
print(quote)
quote=quote.strip()
print(quote)

quote=quote.split()
print(quote)

# Exercise 14
sentence = "Python is powerful" 
sentence= sentence.split()       # We split the sentence (making it a list).
index = sentence.index("is")     # Finds the index in the list where the word "is" is found.
sentence.insert(index+1, "very") # Inserts the word "very" before the specified index (after "is").
sentence = " ".join(sentence)    # The list of words are joined with space " " between them.
print(sentence)
"""
# Exercise 15
word = input("Inserd word: ")
lowCase = 0
upCase= 0
for letter in word: # Cycles between each letter in the word
  
    if(letter.isupper()): # Checks if the letter is lower case, and adds one to the counter if its true
        upCase+=1
    if(letter.islower()):
        lowCase+=1
lowCasePs = lowCase/(lowCase+upCase)*100 # To find the % we divide the number to the sum of the total numbers and multiply by 100

upCasePs = upCase / (lowCase+upCase)*100

print("%.2f%% are upper case, and %.2f%% are lowercase" %(upCasePs, lowCasePs)) # %.2f shows a float to the second value after the decimal
                                                                                # %% shows a percentage symbol