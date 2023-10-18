from gtts import gTTS


def get_speech_obj(input):
    tts = gTTS(input)
    print(tts.text)
    print(tts.tld)
    print(tts.get_bodies())
    print(tts.stream())
    audio_binary = [str(s) for s in tts.stream()]
    # tts.save('hello.mp3')
    return "".join(audio_binary)


if __name__ == "__main__":
    language = "en"

    tts = gTTS('"Ori ila-oorun lori banki OLI St t Morolaji Johnson Ajesara nipasẹ Ormpia Eye (ni apa ọtun)"',
               lang="en",
               tld="co.uk")

    tts.save('hello.mp3')

    print (tts.text)
    print (tts.tld)
    print (tts.get_bodies())
    print (tts.stream())
    for s in tts.stream():
        print (s)
        print ("----")