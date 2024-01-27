import json
from datetime import datetime
from typing import Any, AsyncGenerator, Callable

import redis
from redis import asyncio as aioredis


# Create Redis conection client
def get_async_redis_client():
    try:
        return aioredis.from_url("redis://127.0.0.1:6379", encoding="utf8", decode_responses=True)
    except redis.ConnectionError as e:
        print("Connection error:", e)
    except Exception as e:
        print("An unexpected error occurred:", e)


def is_user_recipient(user_id: int, message: dict[str, Any]) -> bool:
    return str(user_id) == message.get("recipient_id")


async def listen_to_channel(user_id = None, filter_func: Callable = is_user_recipient) -> AsyncGenerator:
    # Create message listener and subscribe on the event source channel
    async with get_async_redis_client().pubsub() as listener:  # Remove unnecessary await
        await listener.subscribe("test")
        # Create a generator that will 'yield' our data into opened connection
        while True:
            message = await listener.get_message(timeout=500, ignore_subscribe_messages=True)
            # Send on connect message
            if message is None:
                yield ""
                continue
            # Send heartbeat message
            if "ping" in message:
                message = {"ping": datetime.now()}
                yield f"data: {json.dumps(message, default=str)}\n\n"
                continue
            message = json.loads(message["data"])
            # Check if the authorized user is a recipient of the notification
            if message:
                yield f"data: {json.dumps(message)}\n\n"
