"use client";

import { useEffect, useState } from "react";
import Button from "../components/Button";

const PostAll = () => {
  const [posts, setPosts] = useState(null);
  const [currentPage, setCurrentPage] = useState(1);

  const fetchData = async () => {
    const response = await fetch(
      `http://127.0.0.1:8000/getAllPosts/?page=${currentPage}`
    ).then((response) => response.json());
    setPosts(response);
  };

  useEffect(() => {
    fetchData();
  }, [currentPage]);

  return (
    <div>
      <div className="grid gap-10 grid-cols-5 mx-3">
        {posts &&
          posts.data.map(({ title, primary_photo, price }, index) => {
            return (
              <ul
                key={index}
                className="flex flex-col text-center border border-t-indigo-600 shadow-xl rounded p-2 max-w-60"
              >
                <li key={title} className="text-2xl">
                  {title}
                </li>
                <li
                  key={primary_photo}
                  className="text-ellipsis overflow-hidden max-w-full"
                >
                  {primary_photo}
                </li>
                <li key={price}>{price}</li>
              </ul>
            );
          })}
      </div>

      <div className="flex justify-center items-center gap-14 my-16 mx-24">
        <Button
          disabled={posts && currentPage == 1 ? true : false}
          onClick={() => {
            setCurrentPage(currentPage - 1);
          }}
        >
          Previous page
        </Button>

        <div className="flex gap-4">
          {posts &&
            posts.meta.links.map(({ active, label }, index) => {
              if (label == "&laquo; Previous" || label == "Next &raquo;") {
                return;
              }

              if (active == true) {
                return (
                  <span
                    key={index}
                    className="flex justify-center items-center text-white text-center bg-indigo-600 border border-indigo-600 min-w-7 max-h-7 cursor-pointer rounded-full transition-colors hover:bg-white hover:text-black"
                    onClick={() => {
                      setCurrentPage(index);
                    }}
                  >
                    {index}
                  </span>
                );
              }

              return (
                <span
                  key={index}
                  className="flex justify-center items-center text-black text-center bg-white border border-indigo-600 min-w-7 max-h-7 cursor-pointer rounded-full transition-colors hover:bg-indigo-600 hover:text-white"
                  onClick={() => {
                    console.log(currentPage);
                    setCurrentPage(index);
                    console.log(currentPage);
                  }}
                >
                  {index}
                </span>
              );
            })}
        </div>

        <Button
          disabled={posts && currentPage == posts.meta.last_page ? true : false}
          onClick={() => {
            setCurrentPage(currentPage + 1);
          }}
        >
          Next page
        </Button>
      </div>
    </div>
  );
};

export default PostAll;
