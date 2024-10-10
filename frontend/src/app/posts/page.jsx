"use client";

import { useEffect, useState } from "react";
import Button from "../components/Button";
import Arrow from "../images/arrow";
import Minus from "../images/Minus";

const PostAll = () => {
  const [posts, setPosts] = useState(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [filter, setFilter] = useState("");

  const fetchData = async () => {
    const response = await fetch(
      `http://127.0.0.1:8000/getAllPosts/?page=${currentPage}&filter=${filter}`
    ).then((response) => response.json());
    setPosts(response);
  };

  useEffect(() => {
    fetchData();
  }, [currentPage, filter]);

  const setFilterPrice = () => {
    if (filter !== "priceAsc" && filter !== "priceDesc") setFilter("priceDesc");

    if (filter == "priceAsc") {
      setFilter("priceDesc");
    } else if (filter == "priceDesc") {
      setFilter("priceAsc");
    }
  };

  const setFilterDate = () => {
    if (filter !== "dateAsc" && filter !== "dateDesc") setFilter("dateDesc");

    if (filter == "dateAsc") {
      setFilter("dateDesc");
    } else if (filter == "dateDesc") {
      setFilter("dateAsc");
    }
  };

  const getFilterImage = (desc, asc) => {
    if (filter == desc) return <Arrow className="ml-2"/>
    if (filter == asc) return <Arrow className="rotate-180 ml-2"/>
    return <Minus className="ml-2"/>
  }

  return (
    <div>
      <div className="flex justify-center gap-10 mt-4 mb-10">

        <Button onClick={() => setFilter("")}>Clear filters</Button>

        <Button onClick={() => setFilterPrice()}>
          Sort by price
          {getFilterImage("priceDesc", "priceAsc")}
        </Button>

        <Button onClick={() => setFilterDate()}>
          Sort by date
          {getFilterImage("dateDesc", "dateAsc")}
        </Button>
      </div>
      <div className="grid gap-10 grid-cols-5 mx-3">
        {posts &&
          posts.data.map(({ title, primary_photo, price }, index) => {
            return (
              <ul
                key={index}
                className="text-center border border-t-indigo-600 shadow-xl rounded p-2 max-w-60"
              >
                <li key={title} className="text-2xl">
                  {title}
                </li>
                <li
                  key={primary_photo}
                  className="break-words overflow-hidden text-sm my-4"
                >
                  {primary_photo}
                </li>
                <li key={price} className="text-green-700 font-bold">{price}</li>
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
