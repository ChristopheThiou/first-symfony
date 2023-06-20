<?php

namespace App\Repository;

use App\Entity\Course;

class CourseRepo{
    public function findAll($page = 1, $pageSize = 10): array
    {
        $list = [];
        $connection = Database::getConnection();
        $offset = ($page - 1) * $pageSize;
        $query = $connection->prepare("SELECT * FROM course  LIMIT :pageSize OFFSET :page");
        $query->bindValue('pageSize', $pageSize, \PDO::PARAM_INT);
        $query->bindValue('page', $offset, \PDO::PARAM_INT);

        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Course($line["id"], $line["title"], $line["subject"], $line["content"], new \DateTime($line["published"]));
        }
        return $list;
    }
    public function findById(int $id): ?Course
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM course WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            return new Course($line["id"], $line["title"], $line["subject"], $line["content"], new \DateTime($line["published"]));
        }
        return null;
    }
    public function persist(Course $course): void
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("INSERT INTO course (title,subject,content, published) VALUES (:title,:subject,:content, :published)");
        $query->bindValue(':title', $course->getTitle());
        $query->bindValue(':subject', $course->getSubject());
        $query->bindValue(':content', $course->getContent());
        $query->bindValue(':published', $course->getDate()->format('Y-m-d'));
        $query->execute();

        $course->setId($connection->lastInsertId());
    }
}