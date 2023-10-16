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

    tts = gTTS('hello world, This is Parkash Testing API', lang=language)

    tts.save('hello.mp3')

    print (tts.text)
    print (tts.tld)
    print (tts.get_bodies())
    print (tts.stream())
    for s in tts.stream():
        print (s)
        print ("----")