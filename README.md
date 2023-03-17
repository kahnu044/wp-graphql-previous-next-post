# WPGraphql Previous-Next Post

Using this plugin, you can get the previous and next post.

### Installation

```sh
Download the latest version of this plugin, upload and activate the plugin
```

### Query usage example

```graphql
query Post {
  post(id: 348, idType: DATABASE_ID) {
    title
    databaseId
    previousPost {
      title
      slug
      uri
      databaseId
      date
      link
      postId
    }
    nextPost {
      title
      slug
      uri
      databaseId
      date
      link
      postId
    }
  }
}
```


### For Same Category
```
previousPost(inSameTerm: true) {
    title
}
nextPost(inSameTerm: true) {
    title
}
```

### Query Response Sample
```
{
  "data": {
    "post": {
      "title": "Kahnu Post",
      "databaseId": 348,
      "previousPost": {
        "title": "Previous  Post",
        "slug": "previous-post",
        "uri": "/previous-post/",
        "databaseId": 345,
        "date": "2023-03-01T06:10:47",
        "link": "http://localhost/wordpress/previous-post/",
        "postId": 345
      },
      "nextPost": {
        "title": "latest post",
        "slug": "latest-post",
        "uri": "/latest-post/",
        "databaseId": 356,
        "date": "2023-03-01T08:18:01",
        "link": "http://localhost/wordpress/latest-post/",
        "postId": 356
      }
    }
  },
  "extensions": {
    "debug": [],
    "queryAnalyzer": {
      "keys": "62ec6195066156850ceed2982fc4ccf2e0623dcc950a6d4526616bb997775289 graphql:Query operation:Post cG9zdDozNDg= cG9zdDozNDU= cG9zdDozNTY=",
      "keysLength": 132,
      "keysCount": 6,
      "skippedKeys": "",
      "skippedKeysSize": 0,
      "skippedKeysCount": 0,
      "skippedTypes": []
    }
  }
}
```