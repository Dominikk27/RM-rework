import mysql.connector
from dotenv import load_dotenv
import os
from abc import ABC, abstractmethod

class Database(ABC):

    def __init__(self):
        load_dotenv()
        self.connection = None

        @abstractmethod
        def connect(self):
            pass

        @abstractmethod
        def close(self):
            pass

        @abstractmethod
        def execute(self, query, params=None):
            pass

        @abstractmethod
        def fetchall(self, query, params=None):
            pass

        @abstractmethod
        def fetchone(self):
            pass


class MYSQLDatabase(Database):
    
    def connect(self):
        self.connection = mysql.connector.connect(
            host=os.getenv("DB_HOST"),
            port=os.getenv("DB_PORT"),
            user=os.getenv("DB_USER"),
            password=os.getenv("DB_PASSWORD"),
            database=os.getenv("DB_NAME")
        )

        if self.connection.is_connected():
            print("Connected to MySQL database")
        else:
            print("Failed to connect to MySQL database")

    def close(self):
        if self.connection:
            self.connection.close()
            print("MySQL database connection closed")

    def execute(self, query, params=None):
        cursor = self.connection.cursor()
        try:
            cursor.execute(query, params)
            self.connection.commit()
            return cursor
        except mysql.connector.Error as err:
            print(f"Error executing query: {err}")
            self.connection.rollback()
            return None
        finally:
            cursor.close()

        
    def fetchall(self, query, params=None):
        cursor = self.connection.cursor()
        try:
            cursor.execute(query, params)
            return cursor.fetchall()
        except mysql.connector.Error as err:
            print(f"Error executing query: {err}")
            return []
        finally:
            cursor.close()

    def fetchone(self, query, params=None):
        cursor = self.connection.cursor()
        try:
            cursor.execute(query, params)
            return cursor.fetchone()
        except mysql.connector.Error as err:
            print(f"Error executing query: {err}")
            return None
        finally:
            cursor.close()
