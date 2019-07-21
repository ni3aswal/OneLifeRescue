from tweepy import Stream
from tweepy import OAuthHandler
from tweepy.streaming import StreamListener
import json

#consumer key, consumer secret, access token, access secret.
ckey="IF9Im9fjEjrBgirVm8JdtevYg"
csecret="4eAMJfqaCv3jPOUUHvvE9qkRAIUHVYw3iirK8P3MZTfp3QYiTY"
atoken="877444984865030144-bH2G0uaXtBpeNe6EQG4RThSWbv8JeYR"
asecret="ifZ1zcNkgU2IFomM7STD0cfmf5GfTqFoebLwgKKhgj2FY"

#code
class listener(StreamListener):

    def on_data(self, data):
        all_data = json.loads(data)
        
        tweet = ascii(all_data["text"])
        
        print((tweet))
        
        return True

    def on_error(self, status):
        print (status)

auth = OAuthHandler(ckey, csecret)
auth.set_access_token(atoken, asecret)

twitterStream = Stream(auth, listener())
twitterStream.filter(track=["accident"])
