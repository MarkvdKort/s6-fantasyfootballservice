#!/bin/bash
sleep 10

mongosh --host mongodb1:27017 <<EOF
  var cfg = {
    "_id": "playReplicaSet",
    "version": 1,
    "members": [
      {
        "_id": 0,
        "host": "mongodb1:27017",
        "priority": 2
      },
      {
        "_id": 1,
        "host": "mongodb2:27017",
        "priority": 0
      },
      {
        "_id": 2,
        "host": "mongodb3:27017",
        "priority": 0
      }
    ]
  };
  rs.initiate(cfg);
EOF