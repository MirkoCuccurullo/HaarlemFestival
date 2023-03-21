<?php
require_once '../model/ticket.php';

include_once("baseRepository.php");

class ticketRepository extends \repository\baseRepository{

        public function getTicket($id){
            $sql = "SELECT * FROM tickets WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function createTicket($ticket){
            $sql = "INSERT INTO tickets (name, description, price, date, location, picture, category, seller) VALUES (:name, :description, :price, :date, :location, :picture, :category, :seller)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['name' => $ticket->name, 'description' => $ticket->description, 'price' => $ticket->price, 'date' => $ticket->date, 'location' => $ticket->location, 'picture' => $ticket->picture, 'category' => $ticket->category, 'seller' => $ticket->seller]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function updateTicket($ticket){
            $sql = "UPDATE tickets SET name = :name, description = :description, price = :price, date = :date, location = :location, picture = :picture, category = :category, seller = :seller WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['name' => $ticket->name, 'description' => $ticket->description, 'price' => $ticket->price, 'date' => $ticket->date, 'location' => $ticket->location, 'picture' => $ticket->picture, 'category' => $ticket->category, 'seller' => $ticket->seller, 'id' => $ticket->id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function deleteTicket($id){
            $sql = "DELETE FROM tickets WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
}